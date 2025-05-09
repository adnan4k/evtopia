<?php

namespace App\Http\Controllers\API;

use App\Enums\Roles;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddFavoriteRequest;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ProductDetailsResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ReviewResource;
use App\Models\GeneraleSetting;
use App\Models\Product;
use App\Models\ProductVisit;
use App\Models\User;
use App\Repositories\ProductRepository;
use App\Repositories\ReviewRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Jenssegers\Agent\Agent;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Retrieve a paginated list of products based on the provided request parameters.
     *
     * @param  Request  $request  The request object containing page, per_page, and search parameters
     * @return Some_Return_Value The JSON response containing total and products data
     */
    public function index(Request $request)
    {
        $page = $request->page;
        $perPage = $request->per_page;
        $skip = ($page * $perPage) - $perPage;

        $search = $request->search;
        $shopID = $request->shop_id;
        $categoryID = $request->category_id;
        $subCategoryID = $request->sub_category_id;

        $rating = $request->rating; //4.0
        $sortType = $request->sort_by;
        $minPrice = $request->min_price;
        $maxPrice = $request->max_price;

        $generaleSetting = GeneraleSetting::first();
        $shop = null;
        if ($generaleSetting?->shop_type == 'single') {
            $shop = User::role(Roles::ROOT->value)->first()?->shop;
        }

        $products = ProductRepository::query()
            ->withCount('orders as orders_count')
            ->withAvg('reviews as average_rating', 'rating')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%'.$search.'%');
            })
            ->when($shop, function ($query) use ($shop) {
                return $query->where('shop_id', $shop->id);
            })
            ->when($shopID && ! $shop, function ($query) use ($shopID) {
                return $query->where('shop_id', $shopID);
            })
            ->when($categoryID, function ($query) use ($categoryID) {
                $query->whereHas('categories', function ($query) use ($categoryID) {
                    return $query->where('id', $categoryID);
                });
            })
            ->when($subCategoryID, function ($query) use ($subCategoryID) {
                $query->whereHas('subcategories', function ($query) use ($subCategoryID) {
                    return $query->where('id', $subCategoryID);
                });
            })
            ->when($minPrice, function ($query) use ($minPrice) {
                $query->where('price', '>=', $minPrice);
            })
            ->when($maxPrice, function ($query) use ($maxPrice) {
                $query->where('price', '<=', $maxPrice);
            })
            ->when($sortType == 'heigh_to_low', function ($query) {
                $query->orderBy('price', 'desc');
            })
            ->when($sortType == 'low_to_high', function ($query) {
                $query->orderBy('price', 'asc');
            })
            ->when($rating, function ($query) use ($rating) {
                $ratingValue = floatval($rating);
                $upperBound = $ratingValue + 1;

                return $query->havingRaw('average_rating >= '.$rating.' AND average_rating < '.$upperBound);
            })
            ->when($sortType == 'top_selling', function ($query) {
                return $query->orderByDesc('orders_count');
            })
            ->when($sortType == 'popular_product', function ($query) {
                return $query->orderByDesc('orders_count')->orderByDesc('average_rating');
            })
            ->when($sortType == 'newest' || $sortType == 'just_for_you', function ($query) {
                return $query->orderBy('id', 'desc');
            })
            ->latest('id')
            ->isActive();

        $total = $products->count();
        $products = $products->when($perPage && $page, function ($query) use ($perPage, $skip) {
            return $query->skip($skip)->take($perPage);
        })->get();

        return $this->json('products', [
            'total' => $total,
            'products' => ProductResource::collection($products),
        ]);
    }



    public function special(Request $request)
    {
        $page = $request->page ?? 1;
        $perPage = $request->per_page ?? 8;
        $skip = ($page * $perPage) - $perPage;

        $generaleSetting = GeneraleSetting::first();
        $shop = null;
        if ($generaleSetting?->shop_type == 'single') {
            $shop = User::role(Roles::ROOT->value)->first()?->shop;
        }


        // latest first
        $specialOffers = ProductRepository::query()
        ->isSpecial()
        ->latest('id')
        ->get();
        $total= $specialOffers->count();


        return $this->json('products', [
            'total' => $total,
            'special_offers' => ProductResource::collection($specialOffers),
        ]);
    }


    /**
     * Show the product details.
     *
     * @param  datatype  $id  description
     * @return response
     */
    public function show(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = ProductRepository::find($request->product_id);
        ProductRepository::recentView($product);

        $relatedProducts = ProductRepository::query()->whereHas('categories', function ($query) use ($product) {
            $query->whereIn('categories.id', $product->categories->pluck('id'));
        })->where('id', '!=', $product->id)
            ->isActive()
            ->inRandomOrder()
            ->limit(6)->get();

        $shop = $product->shop;

        $popularProducts = $shop->products()->isActive()->where('id', '!=', $product->id)->withCount('orders')->withAvg('reviews as average_rating', 'rating')->orderByDesc('average_rating')->orderByDesc('orders_count')->take(6)->get();

        $this->recordVisit($request, $product);

        return $this->json('product details', [
            'product' => ProductDetailsResource::make($product),
            'related_products' => ProductResource::collection($relatedProducts),
            'popular_products' => ProductResource::collection($popularProducts),
        ]);
    }



    /**
     * Record a unique visitor’s view of a product (once per calendar day).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product        $product
     * @return void
     */
    protected function recordVisit(Request $request, Product $product): void
    {
        $visitorId = sha1(
            $request->ip()
          . '|' . $request->header('User-Agent')
        );
    
        $alreadyViewed = ProductVisit::where('product_id', $product->id)
        ->where('visitor_id', $visitorId)
        ->whereDate('created_at', Carbon::today())
        ->exists();

        if ($alreadyViewed) {
            return;
        }

        // 3) Gather metadata
        $ip       = $request->ip();
        $ua       = $request->header('User-Agent');
        $agent    = new Agent();
        $device   = $agent->device();     // e.g. “iPhone”
        $platform = $agent->platform();   // e.g. “iOS”
        $browser  = $agent->browser();    // e.g. “Safari”
        $location = GeoIP::getLocation($ip);

        ProductVisit::create([
            'product_id' => $product->id,
            'visitor_id' => $visitorId,
            'ip_address' => $ip,
            'user_agent' => $ua,
            'device'     => $device,
            'platform'   => $platform,
            'browser'    => $browser,
            'country'    => $location->country,
            'region'     => $location->region,
            'city'       => $location->city,
            'latitude'   => $location->lat,
            'longitude'  => $location->lon,
        ]);
    }


    /**
     * Add or remove favorite product for the user.
     *
     * @param  AddFavoriteRequest  $request  The request for adding a favorite.
     * @return json Response with favorite updated successfully
     */
    public function addFavorite(AddFavoriteRequest $request)
    {
        $product = ProductRepository::find($request->product_id);

        auth()->user()->customer->favorites()->toggle($product->id);

        return $this->json('favorite updated successfully', [
            'product' => ProductResource::make($product),
        ]);
    }

    /**
     * get list of favorite products.
     *
     * @return json Response
     */
    public function favoriteProducts()
    {
        $products = auth()->user()->customer->favorites;

        return $this->json('favorite products', [
            'products' => ProductResource::collection($products),
        ]);
    }

    /**
     * Store a new review.
     *
     * @param  ReviewRequest  $request  The review request
     * @return json Response
     */
    public function storeReview(ReviewRequest $request)
    {
        $product = ProductRepository::find($request->product_id);

        $hasReview = $product->reviews()->where('customer_id', auth()->user()->customer->id)->where('order_id', $request->order_id)->first();

        if ($hasReview) {
            return $this->json('review already exists', [
                'review' => ReviewResource::make($hasReview),
            ]);
        }

        $review = ReviewRepository::storeByRequest($request, $product);

        return $this->json('review added successfully', [
            'review' => ReviewResource::make($review),
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Enums\Roles;
use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ShopResource;
use App\Models\Ad;
use App\Models\GeneraleSetting;
use App\Models\User;
use App\Repositories\BannerRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Index method for retrieving banners, categories, and popular products.
     *
     * @return Some_Return_Value
     */
    public function index(Request $request)
    {
        $page = $request->page ?? 1;
        $perPage = $request->per_page ?? 8;
        $skip = ($page * $perPage) - $perPage;

        $generaleSetting = GeneraleSetting::first();
        $shop = null;
        if ($generaleSetting?->shop_type == 'single') {
            $shop = User::role(Roles::ROOT->value)->first()?->shop;
        }

        $banners = BannerRepository::query()->whereNull('shop_id')->active()->get();

        $categories = CategoryRepository::query()->active()
            ->whereHas('products', function ($product) use ($shop) {
                return $product->where('is_active', true)->when($shop, function ($query) use ($shop) {
                    return $query->where('shop_id', $shop->id);
                });
            })->withCount('products')->orderByDesc('products_count')->take(10)->get();

        // $popularProducts = ProductRepository::query()
        //     ->isActive()->whereHas('orders')
        //     ->when($shop, function ($query) use ($shop) {
        //         return $query->where('shop_id', $shop->id);
        //     })->withCount('orders as orders_count')
        //     ->withAvg('reviews as average_rating', 'rating')
        //     ->orderByDesc('average_rating')
        //     ->orderByDesc('orders_count')
        //     ->take(6)->get();

        $popularProducts = ProductRepository::query()
        ->isActive()
        ->latest('id')
        ->take(6)->get();

        $specialOffers = ProductRepository::query()
        ->isSpecial()
        ->latest('id')
        ->get();

        $popularServices = ServiceRepository::query()
            ->isActive()
            ->orderByDesc('created_at')
            ->take(6)->get();

        $justForYou = ProductRepository::query()->isActive()->latest('id')->when($shop, function ($query) use ($shop) {
            return $query->where('shop_id', $shop->id);
        });
        $total = $justForYou->count();
        $justForYou = $justForYou->skip($skip)->take($perPage)->get();

        $shops = collect([]);

        if ($generaleSetting?->shop_type == 'multi') {
            $shops = ShopRepository::query()->isActive()->whereHas('products', function ($query) {
                return $query->isActive();
            })->whereHas('user', function ($query) {
                return $query->where('is_individual', 0);
            })
            ->withCount('orders')->withAvg('reviews as average_rating', 'rating')->orderByDesc('average_rating')->orderByDesc('orders_count')->take(8)->get();
        }

        $ads = Ad::where('status', 1)->latest('id')->take(2)->get();


        $posts = PostRepository::query()
            ->with(['categories', 'tags', 'comments','user'])
            ->isActive()
            ->latest()
            ->where('add_to_knowledge_hub',0)
            ->take(5)->get();

            
        $knowledge_hubs = PostRepository::query()
            ->with(['categories', 'tags', 'comments','user'])
            ->isActive()
            ->latest()
            ->where('add_to_knowledge_hub',1)
            ->take(5)->get();


    $total = $posts->count();

        return $this->json('home', [
            'banners' => BannerResource::collection($banners),
            'ads' => BannerResource::collection($ads),
            'categories' => CategoryResource::collection($categories),
            'shops' => ShopResource::collection($shops),
            'popular_products' => ProductResource::collection($popularProducts),
            'just_for_you' => [
                'total' => $total,
                'products' => ProductResource::collection($justForYou),
            ],
            'popular_services' => ServiceResource::collection($popularServices),
            'posts' => PostResource::collection($posts),
            'knowledge_hubs' => PostResource::collection($knowledge_hubs),
            'special_offers' => ProductResource::collection($specialOffers),
        ]);
    }

    public function popularProducts(Request $request)
    {

        $popularProducts = ProductRepository::query()
        ->isActive()
        ->latest('id')
        ->take(6)->get();

        return $this->json('popular products', [
            'products' => ProductResource::collection($popularProducts),
        ]);
    }
    /**
     * Get recently viewed products for the current user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function recentlyViews()
    {
        $generaleSetting = GeneraleSetting::first();

        $shop = null;
        if ($generaleSetting?->shop_type == 'single') {
            $shop = User::role(Roles::ROOT->value)->first()?->shop;
        }

        /**
         * @var \App\Models\User $user
         */
        $user = auth()->user();

        $products = $user->recentlyViewedProducts()->when($shop, function ($query) use ($shop) {
            return $query->where('shop_id', $shop->id);
        })->where('is_active', true)->orderBy('pivot_updated_at', 'desc')->take(10)->get();

        return $this->json('recently viewed products', [
            'products' => ProductResource::collection($products),
        ]);
    }
}

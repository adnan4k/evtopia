<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceDetailsResource;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    
    
    public function index(Request $request)
    {
        $page = $request->page;
        $perPage = $request->per_page;
        $skip = ($page * $perPage) - $perPage;

        $search = $request->search;
        $categoryID = $request->category_id;

        $sortType = $request->sort_type;
        $minPrice = $request->min_price;
        $maxPrice = $request->max_price;

      

        $services = ServiceRepository::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%'.$search.'%');
            })
            ->when($categoryID, function ($query) use ($categoryID) {
                $query->whereHas('categories', function ($query) use ($categoryID) {
                    return $query->where('id', $categoryID);
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
            ->when($sortType == 'newest' || $sortType == 'just_for_you', function ($query) {
                return $query->orderBy('id', 'desc');
            })->isActive();

        $total = $services->count();
        $services = $services->when($perPage && $page, function ($query) use ($perPage, $skip) {
            return $query->skip($skip)->take($perPage);
        })->get();

        return $this->json('services', [
            'total' => $total,
            'services' => ServiceResource::collection($services),
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
            'service_id' => 'required|exists:services,id',
        ]);

        $service = Service::find($request->service_id);

        $relatedServices = Service::whereHas('categories', function ($query) use ($service) {
            $query->whereIn('service_categories.id', $service->categories->pluck('id'));
        })->where('id', '!=', $service->id)
            ->isActive()
            ->inRandomOrder()
            ->limit(6)->get();



        return $this->json('product details', [
            'product' => ServiceDetailsResource::make($service),
            'related_products' => ServiceResource::collection($relatedServices),
            'popular_products' => ServiceResource::collection($relatedServices),
        ]);
    }

}

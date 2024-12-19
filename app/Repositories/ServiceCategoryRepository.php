<?php
namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Http\Requests\ServiceCategoryRequest;
use App\Models\ServiceCategory;

class ServiceCategoryRepository extends Repository
{
    public static function model()
    {
        return ServiceCategoryRequest::class;    
    }

    public static function storeByRequest(ServiceCategoryRequest $request): ServiceCategory
    {
        $thumbnail = MediaRepository::storeByRequest(
            $request->file('thumbnail'),
            'categories',
            'image'
        );

        return ServiceCategory::create([
            'name' => $request->name,
            'media_id' => $thumbnail->id ?? null,
            'description' => $request->description,
            'status' => true,
        ]);
    }


    public static function updateByRequest(ServiceCategoryRequest $request, ServiceCategory $category): ServiceCategory
    {
        $thumbnail = $category->media;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = MediaRepository::updateByRequest(
                $request->file('thumbnail'),
                'categories',
                'image',
                $thumbnail
            );
        }
        $category->update([
            'name' => $request->name,
            'media_id' => $thumbnail->id ?? null,
            'description' => $request->description,
        ]);

        return $category;
    }
}
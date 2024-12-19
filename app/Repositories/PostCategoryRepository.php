<?php
namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Http\Requests\PostCategoryRequest;
use App\Models\PostCategory;

class PostCategoryRepository extends Repository
{
    public static function model()
    {
        return PostCategory::class;
    }
    /**
     * store a new category
     */
    public static function storeByRequest(PostCategoryRequest $request): PostCategory
    {
        $thumbnail = MediaRepository::storeByRequest(
            $request->file('thumbnail'),
            'categories',
            'image'
        );

        return self::create([
            'name' => $request->name,
            'media_id' => $thumbnail->id ?? null,
            'description' => $request->description??'',
            'status' => true,
        ]);
    }

    /**
     * update a category
     */
    public static function updateByRequest(PostCategoryRequest $request, PostCategory $category): PostCategory
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
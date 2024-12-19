<?php
namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Http\Requests\ServiceRequest;
use App\Models\Media;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServiceRepository extends Repository
{
    public static function model()
    {
        return Service::class;    
    }


    public static function storeByRequest(ServiceRequest $request): Service
    {
        $thumbnail = MediaRepository::storeByRequest($request->thumbnail, 'services', 'thumbnail', 'image');


        $service = Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'price' => $request->price,
            'duration' => $request->duration,
            'discounted_price' => $request->discount_price,
            'media_id' => $thumbnail->id,
            'code' => $request->code,
            'is_active' => true ,
        ]);

      

        $service->categories()->sync($request->service_category ?? []);


        foreach ($request->additionThumbnail as $additionThumbnail) {
            $thumbnail = MediaRepository::storeByRequest($additionThumbnail, 'services', 'thumbnail', 'image');
            $service->medias()->attach($thumbnail->id);
        }

        return $service;
    }


    public static function updateByRequest(ServiceRequest $request, Service $service): Service
    {
        $thumbnail = $service->media;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = MediaRepository::updateByRequest(
                $request->thumbnail,
                'products',
                'image',
                $thumbnail
            );
        }

      

        self::update($service, [
            'name' => $request->name,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'price' => $request->price,
            'discounted_price' => $request->discounted_price,
            'media_id' => $thumbnail ? $thumbnail->id : null,
            'code' => $request->code,
        ]);

       

        $service->categories()->sync($request->service_category ?? []);


        if ($request->is('api/*')) {
            self::updateAdditionThumbnails($request->previousThumbnail, $service);
        } else {
            foreach ($request->additionThumbnail ?? [] as $additionThumbnail) {
                $thumbnail = MediaRepository::storeByRequest($additionThumbnail, 'products', 'thumbnail', 'image');
                $service->medias()->attach($thumbnail->id);
            }

            self::updatePreviousThumbnail($request->previousThumbnail);
        }

        return $service;
    }



    private static function updatePreviousThumbnail($previousThumbnails)
    {
        foreach ($previousThumbnails ?? [] as $thumbnail) {
            if (array_key_exists('file', $thumbnail) && array_key_exists('id', $thumbnail) && $thumbnail['file'] != null) {
                $media = Media::find($thumbnail['id']);

                MediaRepository::updateByRequest(
                    $thumbnail['file'],
                    'products',
                    'image',
                    $media
                );
            }
        }
    }

 
    private static function updateAdditionThumbnails($additionalThumbnails, $service)
    {
        $ids = [];

        foreach ($additionalThumbnails ?? [] as $additionThumbnail) {
            if (array_key_exists('file', $additionThumbnail) && $additionThumbnail['file'] != null) {

                $media = MediaRepository::storeByRequest($additionThumbnail['file'], 'products', 'thumbnail', 'image');

                $ids[] = $media->id;

                $service->medias()->attach($media->id);
            }

            if (array_key_exists('id', $additionThumbnail) && $additionThumbnail['id'] != null && $additionThumbnail['id'] != 0) {
                $ids[] = $additionThumbnail['id'];
            }
        }

        $previousMedias = $service->medias()->whereNotIn('id', $ids)->get();

        foreach ($previousMedias as $media) {

            $service->medias()->detach($media->id);

            if ($media->src) {
                Storage::delete($media->src);
            }

            $media->delete();
        }
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Service extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function bookingItems()
    {
        return $this->hasMany(BookingItem::class);
    }


    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }



    public function thumbnail(): Attribute
    {
        $thumbnail = asset('defualt/defualt.jpg');
        if ($this->media && $this->media->src) {
            $thumbnail = Storage::url($this->media->src);
        }

        return new Attribute(
            get: fn () => $thumbnail
        );
    }


    public function additionalThumbnails(): Collection
    {
        $thumbnails = collect([]);
        foreach ($this->medias as $media) {
            $thumbnail = asset('defualt/defualt.jpg');
            if ($media && $media->src) {
                $thumbnail = Storage::url($media->src);
            }
            $thumbnails[] = (object) [
                'id' => $media?->id,
                'thumbnail' => $thumbnail,
            ];
        }

        return $thumbnails;
    }

    public function medias(): BelongsToMany
    {
        return $this->belongsToMany(Media::class, 'service_thumbnails');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ServiceCategory::class, 'services_categories');
    }


    public function thumbnails(): Collection
    {
        $thumbnails = collect([]);

        if (request()->is('api/*')) {
            $thumbnails[] = (object) [
                'id' => $this->media?->id,
                'thumbnail' => $this->thumbnail,
            ];
        }

        foreach ($this->medias as $media) {
            $thumbnail = asset('defualt/defualt.jpg');
            if ($media && $media->src) {
                $thumbnail = Storage::url($media->src);
            }
            $thumbnails[] = (object) [
                'id' => $media?->id,
                'thumbnail' => $thumbnail,
            ];
        }

        return $thumbnails;
    }


    public function scopeIsActive(Builder $builder)
    {
        return $builder->where('is_active', true);
    }

    public static function getDiscountPercentage($price, $discountPrice)
    {
        return $discountPrice ? ($price - $discountPrice) * 100 / $price : 0;
    }
}
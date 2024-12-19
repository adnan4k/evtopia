<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class ServiceCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true); 
    }
    public function thumbnail(): Attribute
    {
        $thumbnail = asset('defualt/defualt.jpg');
        if ($this->media && $this->media->src) {
            $thumbnail = Storage::url($this->media->src);
        }
        return Attribute::make(
            get: fn () => $thumbnail
        );
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'services_categories');
    }
}
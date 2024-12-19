<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PostCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_category_post', 'post_category_id', 'post_id');
    }


     /**
     * Scopes a query to only include active records.
     *
     * @param  mixed  $query  The query parameter.
     * @return mixed The return value.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Retrieves the associated media for this model.
     */
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    /**
     * Generates a thumbnail attribute for the media.
     *
     * @return Attribute The generated thumbnail attribute.
     */
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
}
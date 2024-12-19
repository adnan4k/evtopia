<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function categories()
    {
        return $this->belongsToMany(PostCategory::class, 'post_category_post', 'post_id', 'post_category_id');
    }

    // Many-to-many relationship with tags
    public function tags()
    {
        return $this->belongsToMany(PostTag::class, 'post_tag_post', 'post_id', 'post_tag_id');
    }

    // One-to-many relationship with comments
    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function scopeIsActive(Builder $builder)
    {
        return $builder->where('is_active', true);
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

}
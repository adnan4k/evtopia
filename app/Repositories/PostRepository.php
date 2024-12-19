<?php
namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Http\Requests\PostRequest;
use App\Models\Media;
use App\Models\Post;
use Illuminate\Support\Str;

class PostRepository extends Repository
{
    public static function model()
    {
        return Post::class;    
    }


    public static function storeByRequest(PostRequest $request): Post
    {
        $thumbnail = MediaRepository::storeByRequest($request->thumbnail, 'posts', 'thumbnail', 'image');
        $user = auth()->user();

        $slug = Str::slug($request->title); 
        $slug = self::generateUniqueSlug($slug); 
        $post = Post::create([
            'title' => $request->title,
            'slug' => $slug,  
            'description' => $request->description,
            'short_description' => $request->short_description,
            'media_id' => $thumbnail->id,  
            'user_id' => $user->id,  
            'is_active' => $request->is_active ?? true,  
        ]);
    
        $post->categories()->sync($request->post_category ?? []); 
    
        $post->tags()->sync($request->tags ?? []);  
    
        return $post;
    }
    


    public static function updateByRequest(PostRequest $request, Post $post): Post
    {

        $slug = Str::slug($request->title);
        $slug = self::generateUniqueSlug($slug, $post->id);
        $thumbnail = $post->media;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = MediaRepository::updateByRequest(
                $request->thumbnail,
                'posts',
                'image',
                $thumbnail
            );
        }

        $post->update([
            'title' => $request->title,
            'slug' => $slug,  
            'description' => $request->description,
            'short_description' => $request->short_description,
            'media_id' => $thumbnail ? $thumbnail->id : null,  
            'is_active' => $request->is_active ?? true, 
        ]);
    
        $post->categories()->sync($request->post_category ?? []);
    
        $post->tags()->sync($request->tags ?? []); 
    
        return $post; 
    }

    private static function generateUniqueSlug(string $slug, int $excludeId = null): string
    {
        // Check if the slug already exists in the database
        $originalSlug = $slug;
        $count = 1;
    
        // If an ID is provided (i.e., updating), exclude the current post from the uniqueness check
        while (Post::where('slug', $slug)->where('id', '<>', $excludeId)->exists()) {
            // Append a number to the slug to make it unique
            $slug = $originalSlug . '-' . $count++;
        }
    
        return $slug;
    }

 

 
 
}
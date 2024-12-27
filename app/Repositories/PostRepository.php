<?php
namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Http\Requests\PostRequest;
use App\Models\Media;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
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
    
        // Handle PDF file upload (store file path and other metadata in JSON array)
        $pdfs = [];
        if ($request->hasFile('pdf')) {
            foreach ($request->file('pdf') as $pdf) {
                $pdfPath = $pdf->store('posts/pdfs', 'public');
                $pdfs[] = [
                    'path' => $pdfPath,
                    'name' => $pdf->getClientOriginalName(),
                    'size' => $pdf->getSize(),
                ];
            }
        }
    
        // Handle Image file upload (store file path and other metadata in JSON array)
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('posts/images', 'public');
                $images[] = [
                    'path' => $imagePath,
                    'name' => $image->getClientOriginalName(),
                    'size' => $image->getSize(),
                ];
            }
        }
    
        // Handle Video file upload (store file path and other metadata in JSON array)
        $videos = [];
        if ($request->hasFile('video_file')) {
            foreach ($request->file('video_file') as $video) {
                $videoPath = $video->store('posts/videos', 'public');
                $videos[] = [
                    'path' => $videoPath,
                    'name' => $video->getClientOriginalName(),
                    'size' => $video->getSize(),
                ];
            }
        }
    
        // Handle Video Links
        $videoLinks = $request->video_links ?? [];
    
        // Create the post
        $post = Post::create([
            'title' => $request->title,
            'slug' => $slug,  
            'description' => $request->description,
            'add_to_knowledge_hub'=>$request->add_to_knowledge_hub??0,
            'short_description' => $request->short_description,
            'media_id' => $thumbnail->id,  
            'user_id' => $user->id,  
            'is_active' => $request->is_active ?? true,  
            'pdfs' => json_encode($pdfs),  // Store as JSON array
            'images' => json_encode($images),  // Store as JSON array
            'video_links' => json_encode($videoLinks),  // Store as JSON array
        ]);
    
        $post->categories()->sync($request->post_category ?? []); 
        $post->tags()->sync($request->tags ?? []);  
    
        return $post;
    }
    
    


    public static function updateByRequest(PostRequest $request, Post $post)
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
    
        // Handle PDF file upload (store file path and other metadata in JSON array)
    $pdfs = json_decode($post->pdfs, true) ?? [];
    if ($request->hasFile('pdf')) {
        foreach ($request->file('pdf') as $pdf) {
            $pdfPath = $pdf->store('posts/pdfs', 'public');
            $pdfs[] = [
                'path' => $pdfPath,
                'name' => $pdf->getClientOriginalName(),
                'size' => $pdf->getSize(),
            ];
        }
    }



    // Handle PDF files
    $existingPdfs = json_decode($post->pdfs, true) ?? [];
    $newPdfs = $request->input('pdfs', []);

    $updatedPdfs = [];
    
    // Find and keep the PDFs that exist in the new request
    foreach ($existingPdfs as $pdf) {
        // Check if this PDF exists in the incoming request (by path)
        if (in_array($pdf['path'], $newPdfs)) {
            $updatedPdfs[] = $pdf;  // Keep the existing PDF
        } else {
            // If this PDF is not in the request, remove it physically
            Storage::disk('public')->delete($pdf['path']);
        }
    }

    // Add new PDFs from the uploaded files
    if ($request->hasFile('pdf')) {
        foreach ($request->file('pdf') as $pdf) {
            $pdfPath = $pdf->store('posts/pdfs', 'public');
            $updatedPdfs[] = [
                'path' => $pdfPath,
                'name' => $pdf->getClientOriginalName(),
                'size' => $pdf->getSize(),
            ];
        }
    }

    // Handle Images
    $existingImages = json_decode($post->images, true) ?? [];
    $newImages = $request->input('images', []);

    $updatedImages = [];

    // Find and keep the images that exist in the new request
    foreach ($existingImages as $image) {
        // Check if this image exists in the incoming request (by path)
        if (in_array($image['path'], $newImages)) {
            $updatedImages[] = $image;  // Keep the existing image
        } else {
            // If this image is not in the request, remove it physically
            Storage::disk('public')->delete($image['path']);
        }
    }

    // Add new images from the uploaded files
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imagePath = $image->store('posts/images', 'public');
            $updatedImages[] = [
                'path' => $imagePath,
                'name' => $image->getClientOriginalName(),
                'size' => $image->getSize(),
            ];
        }
    }

        // Update the post
        $post->update([
            'title' => $request->title,
            'slug' => $slug,  
            'description' => $request->description,
            'short_description' => $request->short_description,
            'add_to_knowledge_hub' => $request->add_to_knowledge_hub ?? 0,
            'media_id' => $thumbnail ? $thumbnail->id : null,  
            'is_active' => $request->is_active ?? true, 
            'pdfs' => json_encode($updatedPdfs), // Store updated PDFs as JSON array
            'images' => json_encode($updatedImages), // Store updated Images as JSON array
            'video_links' => json_encode($request->video_links),  // Store as JSON array
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
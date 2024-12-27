<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
            return [
                'id' => $this->id,
                'title' => $this->title,
                'slug' => $this->slug,
                'short_description' => $this->short_description,
                'description' => $this->description,
                'banner' => $this->thumbnail,
                // Convert file paths to URLs using Storage::url, or return empty array if no path
               'pdfs' => $this->pdfs ? collect(json_decode($this->pdfs))->map(function ($pdf) {
                    return isset($pdf->path) ? (object) [
                        'name' => $pdf->name, 
                        'size' => $pdf->size,
                        'url' => Storage::url($pdf->path)
                    ] : null;
                })->filter()->values() : [], // Return empty array if no PDFs


                'video_links' => $this->video_links ? collect(json_decode($this->video_links))->map(function ($video) {
                    return $video ? $video : null; // Return null if video link is empty or invalid
                })->filter()->values() : [], // Return empty array if no video links

                'images' => $this->images ? collect(json_decode($this->images))->map(function ($image) {
                    return isset($image->path) ? Storage::url($image->path) : null; // Return null if image path doesn't exist
                })->filter()->values() : [], // Return empty array if no images
                
                'add_to_knowledge_hub' => $this->add_to_knowledge_hub,
                'user_id' => $this->user_id,
                'created_at' => $this->created_at ? $this->created_at->format('M d, Y ') : null,
                'updated_at' => $this->updated_at ? $this->updated_at->format('M d, Y ') : null,
                'categories' => PostCategoryResource::collection($this->whenLoaded('categories')),
                'tags' => PostTagResource::collection($this->whenLoaded('tags')),
                'comments' => PostCommentResource::collection($this->whenLoaded('comments')),
                'author' => new UserResource($this->whenLoaded('user')),
            ];
    }
}

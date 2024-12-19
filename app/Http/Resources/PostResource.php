<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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

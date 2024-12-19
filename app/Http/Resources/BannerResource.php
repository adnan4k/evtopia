<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'cta_text' => $this->cta_text,
            'cta_url' => $this->cta_url,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
        ];
    }
}

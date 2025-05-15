<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $discountPercentage = $this->getDiscountPercentage($this->price, $this->discounted_price);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'thumbnail' => $this->thumbnail,
            'duration' => $this->duration,
            'price' => (float) $this->price,
            'discount_price' => (float) $this->discounted_price,
             'short_description' => $this->short_description,
            'categories' => $this->categories->pluck('name'), 
            'discount_percentage' => (float) number_format($discountPercentage, 2, '.', ''),

        ];
    }
}

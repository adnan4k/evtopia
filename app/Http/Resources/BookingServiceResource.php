<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingServiceResource extends JsonResource
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
            'price' => (float) $this->unit_price,
            'service' => array_merge(
                    $this->service->toArray(),
                    ['thumbnail' => $this->service->thumbnail] // Add the thumbnail attribute here
            ),            
            'order_qty' => (int) $this->quantity,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Retrieve the vehicle information (if it exists)
        $vehicle = $this->customer ? $this->customer->vehicle : null;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'make' => $vehicle ? $vehicle->make : null,  // Vehicle make
            'year' => $vehicle ? $vehicle->year : null,  // Vehicle year
            'model' => $vehicle ? $vehicle->model : null, // Vehicle model
            'phone_verified' => $this->phone_verified_at ? true : false,
            'email' => $this->email,
            'email_verified' => $this->email_verified_at ? true : false,
            'is_active' => (bool) $this->is_active,
            'profile_photo' => $this->thumbnail,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'country' => $this->country,
            'phone_code' => $this->phone_code,
            'notification_disabled'=>$this->customer->notification_enabled??0,
            'vehicle' => $vehicle ? [
                'make' => $vehicle->make,
                'model' => $vehicle->model,
                'year' => $vehicle->year,
                'service_date' => $vehicle->service_date,
            ] : null,
            'total_notifications'=>$this->unreadNotifications()->count()??0,
        ];
    }
}

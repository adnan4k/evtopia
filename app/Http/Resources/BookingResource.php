<?php

namespace App\Http\Resources;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $paymentMethod = PaymentMethod::from($this->payment_method); // Convert string to enum
        if ($this->payment_status === PaymentStatus::PENDING->value && $paymentMethod !== PaymentMethod::CASH) {
            $paymentMethod = PaymentMethod::ONLINE; // Set to enum instance
        }

        return [
            'id' => $this->id,
            'booking_code' => (string) '#'.$this->prefix.''.$this->booking_code,
            'quantity' => (int) $this->bookingItems->sum('quantity'),
            'amount' => (float) number_format($this->payable_amount, 2, '.', ''),
            'payment_method' => $paymentMethod,
            'payment_status' => $this->payment_status,
            'order_status' => $this->order_status,
            'created_at' => $this->created_at,
            'placed_at' => $this->created_at->format('d M, Y h:i A'),
            'address' => AddressResource::make($this->address),
        ];
    }
}
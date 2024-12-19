<?php

namespace App\Http\Resources;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $paymentMethod = $this->payment_method;
        \Log::info($paymentMethod);
        if ($this->payment_status == PaymentStatus::PENDING->value && $paymentMethod != PaymentMethod::CASH->value) {
            $paymentMethod = PaymentMethod::ONLINE->value;
        }

        \Log::info("This : " . $this->bookingItems);
        return [
            'id' => $this->id,
            'booking_code' => (string) '#'.$this->prefix.''.$this->booking_code,
            'order_status' => $this->order_status,
            'created_at' => $this->created_at,
            'placed_at' => $this->created_at->format('d M, Y h:i A'),
            'payment_method' => $paymentMethod,
            'payment_status' => $this->payment_status,
            'total_amount' => (float) number_format($this->total_amount, 2, '.', ''),
            'discount' => (float) number_format($this->discount, 2, '.', ''),
            'coupon_discount' => (float) number_format($this->coupon_discount, 2, '.', ''),
            'payable_amount' => (float) number_format($this->payable_amount, 2, '.', ''),
            'quantity' => (int) $this->bookingItems->sum('quantity'),
            'delivery_charge' => (float) number_format(($this->delivery_charge ?? 0), 2, '.', ''),
            'products' => BookingServiceResource::collection($this->bookingItems),
            'invoice_url' => route('shop.booking-download-invoice', $this->id),
            'address' => AddressResource::make($this->address),
        ];
    }
}

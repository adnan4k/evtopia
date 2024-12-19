<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Booking extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function bookingItems()
    {
        return $this->hasMany(BookingItem::class);
    }

    public function payments(): BelongsToMany
    {
        return $this->belongsToMany(Payment::class, 'booking_payments');
    }
}
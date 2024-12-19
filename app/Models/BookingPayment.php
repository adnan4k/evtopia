<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingPayment extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * get the payment that owns the OrderPayment
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
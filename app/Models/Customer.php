<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get all of the orders for the Customer.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    
    public function vehicle()
    {
        return $this->hasOne(CustomerVehicle::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the user that owns the Customer.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get all of the favorites products for the Customer.
     */
    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'favorites', 'customer_id', 'product_id');
    }

    /**
     * Get the addresses for the user.
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    /**
     * get all cart products for this customer.
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function service_carts(): HasMany
    {
        return $this->hasMany(ServiceCart::class);
    }
}

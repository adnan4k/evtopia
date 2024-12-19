<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarTransmission extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class, 'car_transmission_id');
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }
}
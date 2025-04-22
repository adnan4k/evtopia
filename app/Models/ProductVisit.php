<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVisit extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The product that was viewed.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceCart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function gift(): BelongsTo
    {
        return $this->belongsTo(Gift::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
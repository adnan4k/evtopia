<?php
namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Models\Booking;

class BookingRepository extends Repository
{
    public static function model()
    {
        return Booking::class;    
    }
}
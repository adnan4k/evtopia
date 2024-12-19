<?php
namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Models\BookingItem;

class BookingItemRepository extends Repository
{
    public static function model()
    {
        return BookingItem::class;    
    }
}
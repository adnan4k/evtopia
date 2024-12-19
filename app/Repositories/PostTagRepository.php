<?php
namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Models\PostTag;

class PostTagRepository extends Repository
{
    public static function model()
    {
        return PostTag::class;    
    }
}
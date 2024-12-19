<?php
namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Models\PostComment;

class PostCommentRepository extends Repository
{
    public static function model()
    {
        return PostComment::class;    
    }
}
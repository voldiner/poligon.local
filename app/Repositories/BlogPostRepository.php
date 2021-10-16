<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 16.10.2021
 * Time: 15:40
 */

namespace App\Repositories;
use App\Models\BlogPost as Model;

class BlogPostRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }






}
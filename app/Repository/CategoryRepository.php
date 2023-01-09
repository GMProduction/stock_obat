<?php

namespace App\Repository;

use App\Models\Category;

class CategoryRepository extends BaseRepo
{
    public function getAll(){
        return Category::all();
    }

}

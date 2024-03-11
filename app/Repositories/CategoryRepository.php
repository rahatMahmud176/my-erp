<?php

namespace App\Repositories;

use App\Contracts\CategoryInterface;
use App\Models\Backend\Category;

class CategoryRepository implements CategoryInterface
{
    public function all()
    {
        return Category::all();
    }

    public function store($request)
    {
        Category::newCategory($request);
    }
    public function update($request,$category)
    {
        Category::catUpdate($request,$category);
    }

}
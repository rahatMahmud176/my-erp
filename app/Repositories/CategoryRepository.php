<?php

namespace App\Repositories;

use App\Contracts\CategoryInterface;
use App\Models\Backend\Category;

class CategoryRepository implements CategoryInterface
{
    public function all()
    {
        return Category::paginate(10);
    }

    public function store($request)
    {
        Category::create([
            'name' => $request->name,
        ]); 
    }
    public function update($request,$category)
    {
        $category->update([
            'name'  => $request->name,
        ]);
    }

}
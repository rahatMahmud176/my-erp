<?php

namespace App\Repositories;

use App\Contracts\SubCategoryInterface;
use App\Models\Backend\SubCategory;

class SubCategoryRepository implements SubCategoryInterface
{
    public function all()
    {
       return SubCategory::paginate(10);
    }
    public function store($request)
    {
        SubCategory::create([
            'name' => $request->name,
            'category_id'  => $request->cat,
        ]); 
    }
    public function update($request,$subCategory)
    {
        $subCategory->update([
            'name'  => $request->name,
            'category_id'  => $request->cat,
        ]);
    }
}
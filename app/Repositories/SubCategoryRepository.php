<?php

namespace App\Repositories;

use App\Contracts\SubCategoryInterface;
use App\Models\Backend\SubCategory;

class SubCategoryRepository implements SubCategoryInterface
{
    public function all()
    {
       return SubCategory::all();
    }
    public function store($request)
    {
        SubCategory::newSubCategory($request);
    }
    public function update($request,$subCategory)
    {
        SubCategory::subCatUpdate($request,$subCategory);
    }
}
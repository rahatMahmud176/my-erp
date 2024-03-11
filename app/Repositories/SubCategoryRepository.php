<?php

namespace App\Repositories;

use App\Contracts\subCategoryInterface;
use App\Models\Backend\SubCategory;

class SubCategoryRepository implements subCategoryInterface
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
        SubCategory::catUpdate($request,$subCategory);
    }
}
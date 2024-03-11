<?php

namespace App\Contracts;

interface subCategoryInterface 
{
    public function all();
    public function store($request);
    public function update($request,$subCategory);
}
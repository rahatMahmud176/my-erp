<?php

namespace App\Contracts;

interface CategoryInterface
{
    public function all();
    public function store($request);
    public function update($request,$category);
}
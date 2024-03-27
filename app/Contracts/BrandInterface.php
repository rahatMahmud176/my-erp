<?php 

namespace App\Contracts;

interface BrandInterface 
{
    public function all();
    public function store($request);
}
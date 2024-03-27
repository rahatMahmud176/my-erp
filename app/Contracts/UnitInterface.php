<?php 

namespace App\Contracts;

interface UnitInterface 
{
    public function all();
    public function store($request);
    public function update($request,$unit);
}
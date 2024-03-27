<?php 

namespace App\Contracts;

interface SubUnitInterface 
{
    public function all();
    public function store($request);
    public function update($request,$subUnit);
}
<?php 

namespace App\Contracts;

interface ColorInterface 
{
    public function all();
    public function store($request);
    public function update($request,$color);
}
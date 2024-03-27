<?php 

namespace App\Contracts;

interface SizeInterface 
{
    public function all();
    public function store($request);
    public function update($request,$size);
}
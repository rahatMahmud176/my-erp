<?php

namespace App\Contracts;

interface SupplierInterface
{
    public function all();
    public function store($request);
    public function update($request,$supplier);
}
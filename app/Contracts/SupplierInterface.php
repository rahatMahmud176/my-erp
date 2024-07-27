<?php

namespace App\Contracts;

interface SupplierInterface
{
    public function allSuppliers();
    public function branchSuppliers();
    public function store($request);
    public function update($request,$supplier);
}
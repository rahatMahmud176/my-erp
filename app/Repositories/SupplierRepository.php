<?php

namespace App\Repositories;

use App\Contracts\SupplierInterface;
use App\Models\Backend\Supplier;

class SupplierRepository implements SupplierInterface
{
    public function allSuppliers()
    {
        return Supplier::allSuppliers();
    }
    public function branchSuppliers()
    {
        return Supplier::branchSuppliers();
    }
    public function store($request)
    {
        Supplier::newSupplier($request);
    }
    public function update($request,$supplier)
    {
        Supplier::supplierUpdate($request,$supplier);
    }






}

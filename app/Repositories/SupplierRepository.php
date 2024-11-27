<?php

namespace App\Repositories;

use App\Contracts\SupplierInterface;
use App\Models\Backend\Supplier;

class SupplierRepository implements SupplierInterface
{
    public function allSuppliers()
    {
        return Supplier::orderBy('id','desc')->get();
    }
    public function branchSuppliers()
    {
        return Supplier::where('branch_id', auth()->user()->branch_id)->orderBy('id','desc')->paginate(15);
    }
    public function store($request)
    {
        Supplier::create([
            'name'          => $request->name,
            'phone_number'  => $request->phone_number,
            'branch_id'     => auth()->user()->branch_id
        ]);
    }
    public function update($request,$supplier)
    {
        $supplier->update([
            'name'          => $request->name,
            'phone_number'  => $request->phone_number,
        ]);
    }
    public function show($supplier)
    {
       return $supplier->with([
            'transitions' => function($q){
                $q->select('id','supplier_id','deposit','due','challan_id','note','created_at')->orderBy('id','DESC');
            }
            ])->find($supplier->id);
    }
    public function search($searchKey)
    {
       return Supplier::where('name','like','%'.$searchKey.'%')->paginate(15);
    } 






}

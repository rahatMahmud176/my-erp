<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\SupplierInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
     public $suppliers;


    public function __construct(SupplierInterface $supplierInterface = null) {
        $this->suppliers = $supplierInterface;
    }



    public function index()
    {
        $suppliers = Supplier::all();
        return view('backend.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'  => 'required'
        ]);

        $this->suppliers->store($request);
        notify()->success('Save Successfully ! ','Success');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $supplier = $supplier;
        return view('backend.supplier.form', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $this->validate($request,[
            'name'  => 'required'
        ]); 
        $this->suppliers->update($request,$supplier);
        notify('updated successfully','success');
        return redirect('admin/suppliers');
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        notify()->success('Delete Successfully','Success');
        return back();
    }




}

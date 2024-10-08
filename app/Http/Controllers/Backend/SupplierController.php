<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\AccountInterface;
use App\Contracts\SupplierInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Account;
use App\Models\Backend\Supplier;
use App\Models\Backend\SupplierTransition;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
     public $suppliers;
     public $accounts;


    public function __construct(SupplierInterface $supplierInterface = null,
                                AccountInterface $accountInterface
    ) {
        $this->suppliers = $supplierInterface;
        $this->accounts = $accountInterface;
    }



    public function index()
    {
        $suppliers = Supplier::all();  
        $accounts = $this->accounts->branchAccounts()->skip(1); 
        return view('backend.supplier.index', compact('suppliers','accounts'));
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
         $supplier = $supplier->with([
            'transitions' => function($q){
                $q->select('id','supplier_id','deposit','due','challan_id','note','created_at')->orderBy('id','DESC');
            }
            ])->first();
         return view('backend.supplier.view', compact('supplier'));
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

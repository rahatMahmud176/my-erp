<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\SupplierTransitionInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\SupplierTransition;
use Illuminate\Http\Request;

class SupplierTransitionController extends Controller
{
    public $transitions;
    public function __construct(SupplierTransitionInterface $supplierTransitionInterface = null) {
        $this->transitions = $supplierTransitionInterface;
    } 



    public function index()
    {
        $today     = date('Y-m-d') . ' 00:00:00'; 
        $supplier_transitions = SupplierTransition::select('id','supplier_id','challan_id','deposit','due','created_at')
                                    ->where([['created_at','>=',$today]]) 
                                    ->where('branch_id', auth()->user()->branch_id) 
                                    ->get(); 
        return view('backend.transition-supplier.index', compact('supplier_transitions'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SupplierTransition $supplierTransition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplierTransition $supplierTransition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplierTransition $supplierTransition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierTransition $supplierTransition)
    {
        //
    }


// ajax function 

public function getPreviousMonthSupplierTransitions()
{
    $supplier_transitions = $this->transitions->branchSupplierTransitionsPreviousMonth(); 
    return view('backend.transition-supplier.ajax-body', compact('supplier_transitions'));
}
public function getThisMonthSupplierTransitions()
{
    $supplier_transitions = $this->transitions->branchSupplierTransitions(); 
    return view('backend.transition-supplier.ajax-body', compact('supplier_transitions'));
}

public function getSupplierTransitionsByDate()
{ 
    $getDate = $_GET['date'];
    $supplier_transitions = SupplierTransition::select('id','supplier_id','challan_id','deposit','due','created_at')
                                            ->whereDate('created_at','=',date($getDate))
                                            ->where('branch_id', auth()->user()->branch_id) 
                                            ->get(); 
                                            
    return view('backend.transition-supplier.ajax-body', compact('supplier_transitions'));
}

public function getSupplierTransitionsToday()
{
    $today     = date('Y-m-d') . ' 00:00:00'; 
    $supplier_transitions = SupplierTransition::select('id','supplier_id','challan_id','deposit','due','created_at')
                                ->where([['created_at','>=',$today]]) 
                                ->where('branch_id', auth()->user()->branch_id) 
                                ->get(); 
  return view('backend.transition-supplier.ajax-body', compact('supplier_transitions'));
}







}

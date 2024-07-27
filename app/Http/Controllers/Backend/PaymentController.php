<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\ChallanInterface;
use App\Contracts\SupplierTransitionInterface;
use App\Contracts\TransitionInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Challan;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public $transitions;
     public $supplierTransitions;
     public $challans;


     public function __construct(TransitionInterface $transitionInterface = null,
                                SupplierTransitionInterface $supplierTransitionInterface,
                                ChallanInterface $challanInterface,
     ) {
        $this->transitions = $transitionInterface;
        $this->supplierTransitions = $supplierTransitionInterface;
        $this->challans = $challanInterface;
     }



    public function index()
    {
        //
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
        $challanId = $request->challan_id; 
        $this->challans->pay($request, $challanId);  
        $this->transitions->pay($request,$challanId);  
        $this->supplierTransitions->newSupplierTransition($request,$challanId);

        notify('Success', 'Payment Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

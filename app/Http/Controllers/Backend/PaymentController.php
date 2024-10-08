<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\ChallanInterface;
use App\Contracts\SupplierTransitionInterface;
use App\Contracts\TransitionInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Challan;
use App\Models\Backend\Transition;
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


    public function directPayInfoValidation($request)
    {
        $this->validate($request,[
            'pay'         => 'required',
            'account_id'  => 'required', 
        ],[
            'pay.required'  => 'Amount Field Required', 
        ]);
    }

    public function directPayment(Request $request)
    { 

       $this->directPayInfoValidation($request);

        $challanId = 1; 
        // $this->challans->pay($request, $challanId);  
        $this->transitions->pay($request,$challanId);  
        $this->supplierTransitions->newSupplierTransition($request,$challanId);  
        notify('Payment Successfully','Success');
        return redirect()->back();
    }

    public function directDueIncrease(Request $request)
    {
        $this->validate($request,[
            'due'         => 'required', 
        ],[
            'due.required'  => 'Amount Field Required', 
        ]);

        $challanId = 1;  
        $this->supplierTransitions->newSupplierTransition($request,$challanId); 
        
        notify('Adjustment Successfully','Success');
        return redirect()->back();
        
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

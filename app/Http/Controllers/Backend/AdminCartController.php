<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Account;
use App\Models\Backend\Customer;
use App\Models\Backend\Invoice;
use App\Models\Backend\InvoiceDetails;
use App\Models\Backend\Stock;
use App\Models\Backend\Transition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminCartController extends Controller
{
    
 

/**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $ids = session('ids') ?? [];
        $contents = Stock::select('id','item_id','purchase_price','unit_qty','sub_unit_qty')
                            ->with('item:id,name,unit_id,sub_unit_id')
                            ->whereIn('id',$ids)->get();  
        $accounts = Account::get();
                         
        if ($contents->isEmpty()) {
            notify()->error('The cart is Empty!','Empty');
             return redirect('admin/pos');
        }else{
            return view('backend.cart.index', compact('contents','accounts'));
        }
    }

    public function addToCart()
    {  
        // session()->forget('ids');
       $newId = $_GET['id'];   
       if (!session('ids')) {
            $content=[];         
       }else{
           $content = session('ids'); 
       }
       $com = array_unique(array_merge($content,[$newId])); //com = combine array
       session(['ids'=>$com]);
       $content = session('ids');
       return response('Add to cart successfully');  
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
            'name'             => 'required',
            'phone_number'     => 'required',
            'address'          => 'required', 
            'total'            => 'required', 
            'sale.*.sale_price'=> 'required',
            'sale.*.unit_qty'  => 'required'
         ],[
             'name.required'                => 'Customer name is required',
            'phone_number.required'         => 'Customer phone number is required',
            'address.required'              => 'Customer address is required',
            'sale.*.sale_price.required'    => 'The Sale price is required',
            'sale.*.unit_qty.required'      => 'The Unit Qty is required',
         ]);
        
        


        // need to customer table data send 
        if (!$request->customer_id) {   
           $customer = Customer::create([
                'name'          => $request->name,
                'phone_number'  => $request->phone_number, 
                'address'       => $request->address,
            ]);
        } 
        // need to invoice table data send
       $invoice = Invoice::create([
                'customer_id'  => $request->customer_id ?? $customer->id, 
                'total'         => $request->total, 
                'branch_id'    => auth()->user()->branch_id,
        ]); 
        foreach ($request->sale as $sale) {
            InvoiceDetails::create([
                'invoice_id'    => $invoice->id,
                'stock_id'      => $sale['id'],
                'sale_price'    => $sale['sale_price'],
                'unit_qty'      => $sale['unit_qty'],
                'sub_unit_qty'  => $sale['sub_unit_qty'],
            ]);
 
            // need to stock unit_qty & sub_unit_qty Dicress
            $stock =   Stock::find($sale['id']);
            $stock->unit_qty = $stock->unit_qty - $sale['unit_qty'];
            $stock->sub_unit_qty = $stock->sub_unit_qty - $sale['sub_unit_qty'];
            $stock->save(); 
        } //foreach 

        // need to send data to transition table 

        if ($request->deposit) {
            Transition::create([
                'account_id'   => $request->account_id,
                'challan_id'   => 1,
                'invoice_id'   => $invoice->id ?? 1,
                'branch_id'    => auth()->user()->branch_id,
                'deposit'      => $request->deposit,
            ]);
        }

        
 
        // session()->forget('ids'); todo uncomment

        return view('backend.invoice.invoice', compact('invoice'));
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

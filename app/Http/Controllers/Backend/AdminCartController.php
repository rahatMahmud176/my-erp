<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\AccountInterface;
use App\Contracts\CustomerInterface;
use App\Contracts\InvoiceInterface;
use App\Contracts\SettingInterface;
use App\Contracts\StockInterface;
use App\Contracts\TransitionInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Account; 
use App\Models\Backend\Stock;
use App\Models\Backend\Transition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCartController extends Controller
{
   public $settings; 
   public $customers; 
   public $invoices; 
   public $stocks; 
   public $transitions; 
   public $accounts;
    public function __construct(SettingInterface $settingInterface = null,
                                CustomerInterface $customerInterface,
                                InvoiceInterface $invoiceInterface,
                                StockInterface $stockInterface,
                                TransitionInterface $transitionInterface,
                                AccountInterface $accountInterface,
                                ) {
        $this->settings    = $settingInterface;
        $this->customers   = $customerInterface;
        $this->invoices    = $invoiceInterface;
        $this->stocks      = $stockInterface;
        $this->transitions = $transitionInterface;
        $this->accounts    = $accountInterface;
    }
 

/**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $ids = session('ids') ?? [];
        $contents = Stock::select('id','item_id','purchase_price','unit_qty','sub_unit_qty') 
                            ->with('item:id,name,unit_id,sub_unit_id')
                            ->whereIn('id',$ids)->get();  
        $accounts = $this->accounts->branchAccounts();
                         
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

    public function removeCartItem($id)
    { 
        $ids = session('ids');
         $key = array_search($id,$ids);
         if ($key !== false) {
            unset($ids[$key]);
         } 
       $ids = array_values($ids);
       session(['ids'=>$ids]);
       notify()->error('Remove Successfully','Removed');
       return back();
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

     public function infoValidate($request)
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
     }


    public function store(Request $request)
    {  
        $this->infoValidate($request);  
        DB::beginTransaction(); 
        try { 
            if (!$request->customer_id) {  
                $customerId = $this->customers->newCustomer($request); 
                $invoice    = $this->invoices->newInvoice($request,$customerId); 
             } else{ 
                 $invoice   = $this->invoices->newInvoice($request,$request->customer_id); 
              } 
             foreach ($request->sale as $sale) {
                 $this->invoices->newDetails($sale,$invoice->id);  
                 $this->stocks->decrees($sale); 
             } //foreach  
             if ($request->deposit) { 
                 $this->transitions->deposit($request,$invoice->id);
             }  

            DB::commit(); 
            notify('Checkout successfully','Success'); 
            session()->forget('ids');  
            $company = $this->settings->companyInfo(); 
            return view('backend.invoice.invoice', compact('invoice','company')); 
    } catch (\Exception $e) {
        DB::rollback();
        notify()->error('Please give Proper Info','Error');
        return redirect()->back(); 
    } 
 
        
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
    public function destroy(Stock $id)
    {
        return 'ok';
    }
}

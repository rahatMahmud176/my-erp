<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\AccountInterface;
use App\Contracts\CategoryInterface;
use App\Contracts\ChallanInterface;
use App\Contracts\ColorInterface;
use App\Contracts\CountryVariantInterface;
use App\Contracts\ItemInterface;
use App\Contracts\SettingInterface;
use App\Contracts\SizeInterface;
use App\Contracts\StockInterface;
use App\Contracts\SupplierInterface;
use App\Contracts\SupplierTransitionInterface;
use App\Contracts\TransitionInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Account; 
use App\Models\Backend\Item; 
use App\Models\Backend\Stock; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public $stocks; 
    public $items; 
    public $colors; 
    public $sizes; 
    public $countries; 
    public $suppliers;
    public $setting;
    public $accounts;
    public $challan;
    public $transitions;
    public $supplierTransitions;
    public $categories;

    public function __construct(StockInterface $stockInterface,
                                ItemInterface $itemInterface,
                                ColorInterface $colorInterface,
                                SizeInterface $sizeInterface,
                                CountryVariantInterface $countries,
                                SupplierInterface $supplierInterface,
                                SettingInterface $settingInterface,
                                AccountInterface $accountInterface,
                                ChallanInterface $challanInterface,
                                TransitionInterface $transitionInterface,
                                SupplierTransitionInterface $supplierTransitionInterface,
                                CategoryInterface $categoryInterface
    ) {
        $this->stocks      = $stockInterface;
        $this->items       = $itemInterface;
        $this->colors      = $colorInterface;
        $this->sizes       = $sizeInterface;
        $this->countries   = $countries;
        $this->suppliers   = $supplierInterface;
        $this->setting     = $settingInterface;
        $this->accounts    = $accountInterface;
        $this->challan     = $challanInterface;
        $this->transitions = $transitionInterface;
        $this->supplierTransitions = $supplierTransitionInterface;
        $this->categories = $categoryInterface;
    } 

    public function index()
    {    
        $items = $this->items->allStock();  
        $categories =  $this->categories->all(); 
        return view('backend.stock.index', compact('items','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items      = $this->items->all();
        $colors     = $this->colors->all();
        $sizes      = $this->sizes->all();
        $countries  = $this->countries->all();
        $suppliers  = $this->suppliers->branchSuppliers();
        $accounts   = $this->accounts->branchAccounts();
        $setting    = $this->setting->getSetting();
        $challanId  = $this->challan->getLastChallanId();

        return view('backend.stock.form', compact('items','colors','sizes','countries',
                                                  'suppliers','accounts','setting','challanId'));
    }

    /**
     * Store a newly created resource in storage.
     */ 
     
    public function store(Request $request)
    {    
        if ($this->setting->getSetting()->sub_unit && $this->setting->getSetting()->qty_manage_by_serial) {
            $this->validate($request,[
                'supplier_id'           => 'required',
                'challan'               => 'required',
                'stock.*.item'          => 'required',
                'stock.*.color_id'      => 'required',
                'stock.*.size_id'       => 'required',
                'stock.*.country_id'    => 'required',
                // 'stock.*.unit_qty'      => 'required',
                'stock.*.sub_unit_qty'  => 'required',
                'stock.*.purchase'      => 'required',
                'account_id'            => 'required',
                'total'                 => 'required',
                'pay'                   => 'required',
                'due'                   => 'required',
        ]);
        }else if($this->setting->getSetting()->sub_unit && !$this->setting->getSetting()->qty_manage_by_serial){
            $this->validate($request,[
                'supplier_id'           => 'required',
                'challan'               => 'required',
                'stock.*.item'          => 'required',
                'stock.*.color_id'      => 'required',
                'stock.*.size_id'       => 'required',
                'stock.*.country_id'    => 'required',
                'stock.*.unit_qty'      => 'required',
                'stock.*.sub_unit_qty'  => 'required',
                'stock.*.purchase'      => 'required',
                'account_id'            => 'required',
                'total'                 => 'required',
                'pay'                   => 'required',
                'due'                   => 'required',
        ]);
        }else if(!$this->setting->getSetting()->sub_unit && $this->setting->getSetting()->qty_manage_by_serial){
            $this->validate($request,[
                'supplier_id'           => 'required',
                'challan'               => 'required',
                'stock.*.item'          => 'required',
                'stock.*.color_id'      => 'required',
                'stock.*.size_id'       => 'required',
                'stock.*.country_id'    => 'required',
                // 'stock.*.unit_qty'      => 'required',
                // 'stock.*.sub_unit_qty'  => 'required',
                'stock.*.purchase'      => 'required',
                'account_id'            => 'required',
                'total'                 => 'required',
                'pay'                   => 'required',
                'due'                   => 'required',
        ]);
        }else {
            $this->validate($request,[
                'supplier_id'           => 'required',
                'challan'               => 'required',
                'stock.*.item'          => 'required',
                'stock.*.color_id'      => 'required',
                'stock.*.size_id'       => 'required',
                'stock.*.country_id'    => 'required',
                'stock.*.unit_qty'      => 'required',
                // 'stock.*.sub_unit_qty'  => 'required',
                'stock.*.purchase'      => 'required',
                'account_id'            => 'required',
                'total'                 => 'required',
                'pay'                   => 'required',
                'due'                   => 'required',
            ]);
        }
  

        $challanId = $this->challan->newChallan($request);   
        $this->newStock($challanId,$request);  
        $this->transitions->pay($request,$challanId); 
        $this->supplierTransitions->newSupplierTransition($request,$challanId);

        DB::commit(); 
        notify('Save successfully','Success');
        return redirect()->back();


        DB::beginTransaction();

        try {
                $challanId = $this->challan->newChallan($request);   
                $this->newStock($challanId,$request);  
                $this->transitions->pay($request,$challanId); 
                $this->supplierTransitions->newSupplierTransition($request,$challanId);

                DB::commit(); 
                notify('Save successfully','Success');
                return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            notify()->error('Please give Proper Info','Error');
            return redirect()->back(); 
        } 
        
}


    public function newStock($challanId,$request)
    { 
    foreach ($request->stock as $myStock) {   
        if ($this->setting->getSetting()->qty_manage_by_serial==true) {
            $serials = explode(',', $myStock['serial']); 
            foreach ($serials as $key => $serial) {
                $this->stocks->newStockWithSerial($myStock,$challanId,$serial,$request->supplier_id);
            } 
        } else {
            $this->stocks->newStock($myStock,$challanId,$request->supplier_id); 
        }  
     } //foreach

    }



    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        
    }
    public function stockDetails($itemId)
    {
        $stocks = Stock::where('item_id',$itemId)->get();
        return view('backend.stock.details', compact('stocks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }
 


 //  Ajax Functions

 public function itemInfo()
 {
     $id = $_GET['id'];
     $item =  Item::select('id','name','unit_id','sub_unit_id')
         ->with('unit:id,name')
         ->with('subUnit:id,name')->find($id); 
         return response($item);
 }      
 
 public function acInfoWithOutFirstOne()
 { 
     $accounts =  Account::branchAccounts()->skip(1);
     return response()->view('backend.ajax-results.accounts', compact('accounts'));
 }  

public function addStockRow()
{

    $i = $_GET['i'];  
    $items      = $this->items->all();
    $colors     = $this->colors->all();
    $sizes      = $this->sizes->all();
    $countries  = $this->countries->all();
    $suppliers  = $this->suppliers->branchSuppliers();
    $accounts   = $this->accounts->all();
    $setting    = $this->setting->getSetting();
    $challanId  = $this->challan->getLastChallanId(); 

    return response()->view('backend.ajax-results.stock-row', compact('items','colors','sizes','countries','suppliers','accounts','setting','challanId','i')); 
}


public function stockByCat()
{
    $id = $_GET['id']; 

    $items = Item::select('id','name','unit_id','sub_unit_id')
                      ->with([
                        'stocks' => function($query) {
                            $query->where('branch_id', auth()->user()->branch_id)
                                ->select('id', 'item_id', 'unit_qty', 'branch_id');
                        },
                        'unit:id,name',
                        'subUnit:id,name', 
                      ]) 
                      ->whereHas('categories', function($q) use ($id){
                            $q->where('category_id',$id);
                      }) 
                    ->get(); 
    return response()->view('backend.stock.ajax-body', compact('items')); 
}






}

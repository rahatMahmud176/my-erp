<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\AccountInterface;
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
use App\Models\Backend\Item; 
use App\Models\Backend\Stock; 
use Illuminate\Http\Request; 

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
                                SupplierTransitionInterface $supplierTransitionInterface
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
    } 


    public function index()
    {   
        $items = $this->items->allStock();
        return view('backend.stock.index', compact('items'));
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
        $suppliers  = $this->suppliers->all();
        $accounts   = $this->accounts->all();
        $setting    = $this->setting->getSetting();
        $challanId  = $this->challan->getLastChallanId();

        return view('backend.stock.form', compact('items','colors','sizes','countries','suppliers','accounts','setting','challanId'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function itemInfo()
    {
        $id = $_GET['id'];
        $item =  Item::select('id','name','unit_id','sub_unit_id')
            ->with('unit:id,name')
            ->with('subUnit:id,name')->find($id);

            return response($item);
    }         
 
    public function store(Request $request)
    {  
       

        $challanId = $this->challan->newChallan($request); 
        $this->stocks->newStock($request,$challanId); 
        $this->transitions->newTransitionWithNewStock($request,$challanId); 
        $this->supplierTransitions->newSupplierTransitionWithNewStock($request,$challanId);
        return 'ok';
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
}

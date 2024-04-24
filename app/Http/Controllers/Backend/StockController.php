<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\ColorInterface;
use App\Contracts\CountryVariantInterface;
use App\Contracts\ItemInterface;
use App\Contracts\SizeInterface;
use App\Contracts\StockInterface;
use App\Contracts\SupplierInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public $stocks; 
    public $items; 
    public $colors; 
    public $sizes; 
    public $countries; 
    public $suppliers; 

    public function __construct(StockInterface $stockInterface,
                                ItemInterface $itemInterface,
                                ColorInterface $colorInterface,
                                SizeInterface $sizeInterface,
                                CountryVariantInterface $countries,
                                SupplierInterface $supplierInterface,
                                
    ) {
        $this->stocks    = $stockInterface;
        $this->items     = $itemInterface;
        $this->colors    = $colorInterface;
        $this->sizes     = $sizeInterface;
        $this->countries = $countries;
        $this->suppliers = $supplierInterface;
    } 


    public function index()
    {   
        $stocks = Stock::where('branch_id',auth()->user()->branch_id)->get(); 
        return view('backend.stock.index', compact('stocks'));
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

        return view('backend.stock.form', compact('items','colors','sizes','countries','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->stocks->newStock($request);
        return 'ok';
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
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

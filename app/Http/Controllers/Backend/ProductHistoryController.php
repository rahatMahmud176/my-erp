<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\StockInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\InvoiceDetails;
use App\Models\Backend\Stock;
use Illuminate\Http\Request;

class ProductHistoryController extends Controller
{
    public $stocks;
    public function __construct(StockInterface $stockInterface = null) {
        $this->stocks = $stockInterface;
    } 

    public function index()
    {  
       $stocks = $this->stocks->productHistoryBranch();
       return view('backend.product-history.index', compact('stocks'));
    }

    public function searchProductHistoryBranch()
    {
         $string = $_GET['string'];
         $stocks = $this->stocks->searchProductHistoryBranch($string);
         return response()->view('backend.product-history.ajax-body', compact('stocks'));
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

<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\ItemInterface;
use App\Contracts\SettingInterface;
use App\Contracts\StockInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Pos;
use App\Models\Backend\Stock;
use Illuminate\Http\Request;

class PosController extends Controller
{
     public $stocks;
     public $settings;

    public function __construct(StockInterface $stockInterface,
                                SettingInterface $settingInterface
                                                            )
    {
        $this->stocks = $stockInterface;
        $this->settings = $settingInterface;
    }


    public function index()
    {
        $stocks =  $this->stocks->branchStocks(); 
        $settings = $this->settings->getSetting(); 
        return view('backend.pos.index', compact('stocks','settings'));
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
    public function show(Pos $pos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pos $pos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pos $pos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pos $pos)
    {
        //
    }


//  ajax functions 
    public function searchResult()
    {
        $searchKey = $_GET['searchKey'];
        $stocks = Stock::searchResult($searchKey);
        return response()->view('backend.pos.ajax-body', compact('stocks'));
    }











}

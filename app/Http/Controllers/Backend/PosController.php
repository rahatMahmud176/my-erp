<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\ItemInterface;
use App\Contracts\StockInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Pos;
use Illuminate\Http\Request;

class PosController extends Controller
{
     public $stocks;

    public function __construct(StockInterface $stockInterface)
    {
        $this->stocks = $stockInterface;
    }


    public function index()
    {
        $stocks =  $this->stocks->all();
        
        return view('backend.pos.index', compact('stocks'));
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
}

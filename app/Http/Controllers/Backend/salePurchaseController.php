<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\ItemInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Item;
use Illuminate\Http\Request;

class salePurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public $items;

    public function __construct(ItemInterface $itemInterface) {
        $this->items = $itemInterface;
    }








    public function index()
    {
        $items = $this->items->allStock();   

        return view('backend.item.history.index', compact('items'));
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
       $item = Item::select('id','name')->with([
                            'challan_details',
                            'challan_details.challan:id,supplier_id',
                            'challan_details.challan.supplier:id,name',
                            'stocks:id,item_id',
                            'stocks.invoice_details:invoice_id,unit_qty,created_at,stock_id'
                        ])->find($id);

    //    return $item->challan_details;

       return view('backend.item.history.view', compact('item'));

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

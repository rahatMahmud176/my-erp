<?php

namespace App\Repositories;

use App\Contracts\ItemInterface;
use App\Models\Backend\Item;
use App\Models\Backend\Stock;

class ItemRepository implements ItemInterface
{
    public function all()
    {
        return Item::orderBy('id','desc')->get();
    } 
    public function newItem($request)
    {
        Item::newItem($request);
    }
    public function updateItem($request,$item)
    {
        Item::updateItem($request,$item);
    }


    public function allStock()
    {
        

       return Item::with([
        'stocks' => function($query) {
            $query->where('branch_id', auth()->user()->branch_id)
                  ->select('id', 'item_id', 'unit_qty', 'branch_id');
        },
        'unit:id,name',
        'subUnit:id,name'
    ])->get();
    }
    



}
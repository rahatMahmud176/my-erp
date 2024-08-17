<?php

namespace App\Repositories;

use App\Contracts\ItemInterface;
use App\Models\Backend\Item;

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
       return Item::select('id','name','unit_id','sub_unit_id')
                      ->with([
                        'stocks:item_id,unit_qty,branch_id',
                        'unit:id,name',
                        'subUnit:id,name'
                      ]) 
                      ->where('branch_id',auth()->user()->branch_id) 
                    ->get();
    }
    



}
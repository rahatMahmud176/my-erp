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


}
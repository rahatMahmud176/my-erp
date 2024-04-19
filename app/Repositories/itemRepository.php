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
}
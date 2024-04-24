<?php

namespace App\Repositories;

use App\Contracts\StockInterface;
use App\Models\Backend\Stock;

class StockRepository implements StockInterface
{
    public function all()
    {
        return Stock::all();
    }
    public function newStock($request)
    {
        Stock::newStock($request);
    }
    public function updateStock($request,$category)
    {
        Stock::updateStock($request,$category);
    }
}
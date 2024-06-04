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
    public function newStock($request,$challanId)
    {
        Stock::newStock($request,$challanId);
    }
    public function newStockWithSerial($request,$challanId,$serial)
    {
        Stock::newStockWithSerial($request,$challanId,$serial);
    } 
    public function updateStock($request,$category)
    {
        Stock::updateStock($request,$category);
    }









}
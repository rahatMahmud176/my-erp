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
    public function newStock($request,$challanId,$supplier_id)
    {
        Stock::newStock($request,$challanId,$supplier_id);
    }
    public function newStockWithSerial($request,$challanId,$serial,$supplier_id)
    {
        Stock::newStockWithSerial($request,$challanId,$serial,$supplier_id);
    } 
    public function updateStock($request,$category)
    {
        Stock::updateStock($request,$category);
    }









}
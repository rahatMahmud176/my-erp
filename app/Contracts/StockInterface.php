<?php

namespace App\Contracts;

interface StockInterface
{
    public function all();
    public function newStock($request,$challanId,$supplier_id);
    public function newStockWithSerial($request,$challanId,$serial,$supplier_id);
    public function updateStock($request,$stock);
}
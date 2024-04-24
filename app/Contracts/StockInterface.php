<?php

namespace App\Contracts;

interface StockInterface
{
    public function all();
    public function newStock($request);
    public function updateStock($request,$stock);
}
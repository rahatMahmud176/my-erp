<?php

namespace App\Contracts;

interface StockInterface
{
    public function allStocks();
    public function branchStocks();
    public function productHistoryBranch();
    public function searchProductHistoryBranch($string);
    public function searchResult($searchKey);
    public function newStock($request,$challanId,$supplier_id);
    public function newStockWithSerial($request,$challanId,$serial,$supplier_id);
    public function updateStock($request,$stock);
    public function decrees($sale);
}
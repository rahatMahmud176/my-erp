<?php

namespace App\Repositories;

use App\Contracts\ChallanInterface;
use App\Models\Backend\Challan;

class ChallanRepository implements ChallanInterface
{

    public function all()
    {
        return Challan::select('id','total','due','pay','created_at','supplier_id','deletable')
        ->with('supplier:id,name')
        ->orderBy('id','desc')
        ->get();
    }
    public function newChallan($request)
    {
        return Challan::newChallan($request);
    }
    public function getLastChallanId()
    {
        return Challan::getLastChallanId();
    }

    public function pay($request, $challanId)
    {
        return Challan::pay($request, $challanId);
    }












}
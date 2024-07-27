<?php

namespace App\Repositories;

use App\Contracts\ChallanInterface;
use App\Models\Backend\Challan;

class ChallanRepository implements ChallanInterface
{

    public function allChallan()
    {
        return Challan::allChallan(); ;
    }
    public function branchChallan()
    {
        return Challan::branchChallan(); ;
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
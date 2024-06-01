<?php

namespace App\Repositories;

use App\Contracts\TransitionInterface;
use App\Models\Backend\Transition;

class TransitionRepository implements TransitionInterface
{
    public function newTransitionWithNewStock($request,$challanId)
    {
       Transition::newTransitionWithNewStock($request,$challanId);
    }

    public function all()
    {
      return  Transition::select('created_at','account_id','challan_id','deposit','pay')
        ->with([
           'account:id,ac_title',
           'challan:id,supplier_id',
           'challan.supplier:id,name'
           ])->orderBy('id','desc')->get();
    }


}
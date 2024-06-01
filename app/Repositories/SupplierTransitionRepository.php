<?php

namespace App\Repositories;

use App\Contracts\SupplierTransitionInterface;
use App\Models\Backend\SupplierTransition;

class SupplierTransitionRepository implements SupplierTransitionInterface
{
   public function newSupplierTransitionWithNewStock($request,$challanId)
   {
        SupplierTransition::newSupplierTransitionWithNewStock($request,$challanId);
   }
   public function all()
   {
      return SupplierTransition::select('id','supplier_id','challan_id','deposit','due')
      ->with([
          'challan:id',
          'supplier:id,name'
      ])->orderBy('id','desc')->get();
   }







}
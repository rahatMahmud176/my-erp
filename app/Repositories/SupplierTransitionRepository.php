<?php

namespace App\Repositories;

use App\Contracts\SupplierTransitionInterface;
use App\Models\Backend\SupplierTransition;

class SupplierTransitionRepository implements SupplierTransitionInterface
{
   public function newSupplierTransition($request,$challanId)
   {
        SupplierTransition::newSupplierTransition($request,$challanId);
   }
   public function allSupplierTransitions()
   {
      return SupplierTransition::allSupplierTransitions();
   }
   public function branchSupplierTransitions()
   {
      return SupplierTransition::branchSupplierTransitions(); 
   }







}
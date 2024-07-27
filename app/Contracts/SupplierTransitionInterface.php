<?php

namespace App\Contracts;


interface SupplierTransitionInterface
{
   public function newSupplierTransition($request,$challanId);

   public function allSupplierTransitions();
   public function branchSupplierTransitions();








}


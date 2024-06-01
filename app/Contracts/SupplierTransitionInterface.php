<?php

namespace App\Contracts;


interface SupplierTransitionInterface
{
   public function newSupplierTransitionWithNewStock($request,$challanId);

   public function all();








}
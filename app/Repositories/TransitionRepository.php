<?php

namespace App\Repositories;

use App\Contracts\TransitionInterface;
use App\Models\Backend\Transition;

class TransitionRepository implements TransitionInterface
{


   public function allTransitions()
   {
   return Transition::allTransitions();
   }

   public function branchTransitions()
   {
   return Transition::branchTransitions();
   } 
   public function deposit($request,$invoiceId)
   {
         Transition::deposit($request,$invoiceId);
   } 
   public function pay($request,$challanId)
   {
      Transition::pay($request,$challanId);
   }



}
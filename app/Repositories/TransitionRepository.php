<?php

namespace App\Repositories;

use App\Contracts\TransitionInterface;
use App\Models\Backend\Transition;

class TransitionRepository implements TransitionInterface
{

   public $today;

   public function __construct() {
      $this->today = date('Y-m-d') . ' 00:00:00'; 
   }

   public function allTransitions()
   {
   return Transition::allTransitions();
   }

   public function branchTransitions()
   {
   return Transition::branchTransitions();
   } 
   public function branchTransitionsPreviousMonth()
   {
   return Transition::branchTransitionsPreviousMonth();
   } 
   public function deposit($request,$invoiceId)
   {
         Transition::deposit($request,$invoiceId);
   } 
   public function pay($request,$challanId)
   {
      Transition::pay($request,$challanId);
   }

   public function todayPayment()
   {
      return Transition::where([['created_at','>=',$this->today]]) 
      ->where('branch_id', auth()->user()->branch_id)->sum('pay');
   }


}
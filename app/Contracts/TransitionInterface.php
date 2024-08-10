<?php

namespace App\Contracts;

interface TransitionInterface 
{
    public function allTransitions();
    public function branchTransitions();
    public function branchTransitionsPreviousMonth();
    public function pay($request,$challanId); 
    public function deposit($request,$invoiceId);







}
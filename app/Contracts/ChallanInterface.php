<?php
namespace App\Contracts;

interface ChallanInterface 
{
    public function allChallan();
    public function branchChallan();
    public function newChallan($request);
    public function getLastChallanId();
    public function pay($request, $challanId);

}
<?php
namespace App\Contracts;

interface ChallanInterface 
{
    public function all();
    public function newChallan($request);
    public function getLastChallanId();
    public function pay($request, $challanId);

}
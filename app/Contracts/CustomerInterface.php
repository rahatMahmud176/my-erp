<?php

namespace App\Contracts;

interface CustomerInterface
{
    public function newCustomer($request);
    public function all();
}
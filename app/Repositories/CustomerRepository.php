<?php
namespace App\Repositories;

use App\Contracts\CustomerInterface;
use App\Models\Backend\Customer;

class CustomerRepository implements CustomerInterface
{
    public function newCustomer($request)
    { 
       return Customer::newCustomer($request);
    }
    public function all()
    {
        return  Customer::allCustomers();
    }

}
<?php

namespace App\Http\Controllers;

use App\Contracts\CustomerInterface;
use App\Http\Requests\CustomerRequest;
use App\Models\Backend\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public $customers;

    public function __construct(CustomerInterface $customerInterface) {
        $this->customers = $customerInterface;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $customers = $this->customers->all(); 
        return view('backend.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */ 

    public function store(CustomerRequest $request)
    {  
        $this->customers->newCustomer($request);
        notify('Customer Save Successfully','Success');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }



    // ajax function
    public function findCustomer()
    {
        $number = $_GET['number'];
        $customer = Customer::where('phone_number','LIKE','%'.$number.'%')->first();

        return response($customer);

    }   












}

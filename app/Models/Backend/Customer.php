<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


public static function allCustomers()
{
    return Customer::select('id','name','phone_number','address')->orderBy('id','DESC')->get();
}


public static function newCustomer($request)
{
   $customer = Customer::create([
        'name'          => $request->name,
        'phone_number'  => $request->phone_number, 
        'address'       => $request->address,
    ]);
    return $customer->id;
}




public function invoices()
{
    return $this->hasMany(Invoice::class);
}




}

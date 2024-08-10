<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


public static function allInvoices()
{
    return Invoice::orderBy('id','desc')->get();
} 

public static function branchInvoices()
{ 
    $today     = date('Y-m-d') . ' 00:00:00';
    return Invoice::select('id','total','customer_id','deletable','created_at','branch_id')
    ->where([['created_at','>=',$today]]) 
    ->where('branch_id', auth()->user()->branch_id)
    ->with('transitions:id,deposit,invoice_id')
    ->with('customer:id,name,phone_number')  
    ->get();
} 

public static function branchInvoicesThisMonth()
{
    $thisMonth = date('m'); 
    return Invoice::select('id','total','customer_id','deletable','created_at','branch_id') 
    ->whereraw('MONTH(created_at) = ?', [$thisMonth])
    ->where('branch_id', auth()->user()->branch_id)
    ->with('transitions:id,deposit,invoice_id')
    ->with('customer:id,name,phone_number')  
    ->get();
} 



public static function newInvoice($request, $customerId)
{
 $invoice = Invoice::create([
            'customer_id'  => $request->customer_id ?? $customerId, 
            'total'         => $request->total, 
            'branch_id'    => auth()->user()->branch_id,
        ]);
        return $invoice;
}
















 

public function details()
{
    return $this->hasMany(InvoiceDetails::class);
} 
public function customer()
{
    return $this->belongsTo(Customer::class);
}
public function branch()
{
    return $this->belongsTo(Branch::class);
}
public function transitions()
{
    return $this->hasMany(Transition::class);
} 





}

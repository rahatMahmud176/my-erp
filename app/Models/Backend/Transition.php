<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transition extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public static function allTransitions()
    {
       return Transition::select('created_at','account_id','challan_id','invoice_id','deposit','pay')
        ->with([
           'account:id,ac_title',
           'challan:id,supplier_id',
           'challan.supplier:id,name',
           'invoice:id,customer_id',
           'invoice.customer:id,name,phone_number'
           ])->orderBy('id','desc')->get();
    }

    public static function branchTransitions()
    {
       $thisMonth = date('m');
       return Transition::select('created_at','account_id','challan_id','invoice_id','deposit','pay')
                        ->where('branch_id', auth()->user()->branch_id)
                        ->whereraw('MONTH(created_at) = ?', $thisMonth)
                        ->with([
                        'account:id,ac_title',
                        'challan:id,supplier_id',
                        'challan.supplier:id,name',
                        'invoice:id,customer_id',
                        'invoice.customer:id,name,phone_number'
                        ])->orderBy('id','desc')->get();
    }

    public static function branchTransitionsPreviousMonth()
    {
       $thisMonth = date('m');
       return Transition::select('created_at','account_id','challan_id','invoice_id','deposit','pay')
                        ->where('branch_id', auth()->user()->branch_id)
                        ->whereraw('MONTH(created_at) = ?', $thisMonth -1)
                        ->with([
                        'account:id,ac_title',
                        'challan:id,supplier_id',
                        'challan.supplier:id,name',
                        'invoice:id,customer_id',
                        'invoice.customer:id,name,phone_number'
                        ])->orderBy('id','desc')->get();
    }
    

    public static function pay($request,$challanId)
    {
        Transition::create([
            'account_id'   => $request->account_id,
            'challan_id'   => $challanId ?? 1,
            'invoice_id'   => 1,
            'branch_id'    => auth()->user()->branch_id,
            'pay'          => $request->pay,
        ]); 
    } 
    public static function deposit($request,$invoiceId)
    {
        Transition::create([
            'account_id'   => $request->account_id,
            'challan_id'   => 1,
            'invoice_id'   => $invoiceId ?? 1,
            'branch_id'    => auth()->user()->branch_id,
            'deposit'      => $request->deposit,
        ]);
    }





// public function supplier()
// {
//     return $this->belongsTo(Supplier::class);
// }

public function account()
{
    return $this->belongsTo(Account::class);
}
public function challan()
{
    return $this->belongsTo(Challan::class);
}
public function invoice()
{
    return $this->belongsTo(Invoice::class);
}




}

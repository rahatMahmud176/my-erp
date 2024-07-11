<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transition extends Model
{
    use HasFactory;

    protected $guarded = ['id'];



    public static function newTransition($request,$challanId)
    {
        Transition::create([
            'account_id'   => $request->account_id,
            'challan_id'   => $challanId ?? 1,
            'invoice_id'   => 1,
            'branch_id'    => auth()->user()->branch_id,
            'pay'          => $request->pay,
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




}

<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierTransition extends Model
{
    use HasFactory;

    protected $guarded = ['id'];



    public static function newSupplierTransitionWithNewStock($request,$challanId)
    {
        SupplierTransition::create([
            'supplier_id'   => $request->supplier_id,
            'challan_id'    => $challanId ?? 1,
            'branch_id'     => auth()->user()->branch_id,
            'deposit'       => $request->pay,
            'due'           => $request->due,
        ]);
    }




    public function challan()
    {
        return $this->belongsTo(Challan::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }


}

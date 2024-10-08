<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierTransition extends Model
{
    use HasFactory;

    protected $guarded = ['id'];



    public static function allSupplierTransitions()
    {
       return SupplierTransition::select('id','supplier_id','challan_id','deposit','due')
       ->with([
           'challan:id',
           'supplier:id,name'
       ])->orderBy('id','desc')->get();
    }
    public static function branchSupplierTransitions()
    {
        $thisMonth = date('m');
       return SupplierTransition::select('id','supplier_id','challan_id','deposit','due','created_at')
                                  ->where('branch_id', auth()->user()->branch_id)
                                  ->whereraw('MONTH(created_at) = ?',$thisMonth)
                                  ->with([
                                     'challan:id',
                                     'supplier:id,name'
                                  ])->orderBy('id','desc')->get();
    }
    public static function branchSupplierTransitionsPreviousMonth()
    {
        $thisMonth = date('m');
       return SupplierTransition::select('id','supplier_id','challan_id','deposit','due','created_at')
                                  ->where('branch_id', auth()->user()->branch_id)
                                  ->whereraw('MONTH(created_at) = ?',$thisMonth-1)
                                  ->with([
                                     'challan:id',
                                     'supplier:id,name'
                                  ])->orderBy('id','desc')->get();
    }



    public static function newSupplierTransition($request,$challanId)
    {
        SupplierTransition::create([
            'supplier_id'   => $request->supplier_id,
            'challan_id'    => $challanId ?? 1,
            'branch_id'     => auth()->user()->branch_id,
            'deposit'       => $request->pay ?? 0,
            'due'           => $request->due ?? 0,
            'note'          => $request->note ?? '-'
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

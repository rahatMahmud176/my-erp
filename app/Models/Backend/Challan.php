<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


public static function allChallan()
{
   return Challan::select('id','total','due','pay','created_at','supplier_id','deletable')
    ->with('supplier:id,name')
    ->orderBy('id','desc')
    ->get();
}
public static function branchChallan()
{
   return Challan::select('id','total','due','pay','created_at','supplier_id','deletable')
    ->where('branch_id', auth()->user()->branch_id)
    ->with('supplier:id,name')
    ->orderBy('id','desc')
    ->get();
}




public static function newChallan($request)
{
   $challan =  Challan::create([
        'supplier_id'  => $request->supplier_id,
        'total'        => $request->total,
        'pay'          => $request->pay,
        'due'          => $request->due,
        'branch_id'    => auth()->user()->branch_id,
    ]); 
    return $challan->id; 
}


public static function pay($request, $challanId)
{
    $challan = Challan::find($challanId);
    $challan->due = $challan->due - $request->pay;
    $challan->pay = $challan->pay + $request->pay;
    $challan->save();
}


public static function getLastChallanId()
{
   return Challan::all()->last()->id +1;
}





public function supplier()
{
    return $this->belongsTo(Supplier::class);
}







}

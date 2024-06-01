<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


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


public static function getLastChallanId()
{
   return Challan::count()+1;
}





public function supplier()
{
    return $this->belongsTo(Supplier::class);
}







}

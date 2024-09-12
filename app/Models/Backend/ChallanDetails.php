<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallanDetails extends Model
{
    use HasFactory;
    protected $guarded = ['id'];



public static function new($request,$challanId,$supplier_id)
{
    ChallanDetails::create([
        'supplier_id'        =>$supplier_id,
        // 'supplier_id'        =>1,
        'item_id'            =>$request['item'],
        'color_id'           =>$request['color_id'] ?? 1,
        'size_id'            =>$request['size_id'] ?? 1,
        'country_id'         =>$request['country_id'] ?? 1,
        'unit_qty'           =>$request['unit_qty'] ?? 1,
        'sub_unit_qty'       =>$request['sub_unit_qty'] ?? 0,
        'purchase_price'     =>$request['purchase'], 
        'branch_id'          => auth()->user()->branch_id,
        'serial'             =>$request['serial'] ?? '0',
        'challan_id'         =>$challanId, 
    ]);
}


public static function newWithSerial($request,$challanId,$serial,$supplier_id)
{
    ChallanDetails::create([
        'supplier_id'        =>$supplier_id,
        // 'supplier_id'        =>1,
        'item_id'            =>$request['item'],
        'color_id'           =>$request['color_id'] ?? 1,
        'size_id'            =>$request['size_id'] ?? 1,
        'country_id'         =>$request['country_id'] ?? 1,
        'unit_qty'           =>$request['unit_qty'] ?? 1,
        'sub_unit_qty'       =>$request['sub_unit_qty'] ?? 0,
        'purchase_price'     =>$request['purchase'], 
        'branch_id'          => auth()->user()->branch_id,
        'serial'             =>$serial,
        'challan_id'         =>$challanId, 
    ]);
}












public function item()
{
    return $this->belongsTo(Item::class);
}

public function size()
{
    return $this->belongsTo(Size::class);
}
public function color()
{
    return $this->belongsTo(Color::class);
}
public function country()
{
    return $this->belongsTo(CountryVariant::class);
} 
public function user()
{
    return $this->belongsTo(User::class);
} 

public function challan()
{
    return $this->belongsTo(Challan::class);
}   






}

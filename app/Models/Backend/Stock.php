<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Stock extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public static function newStock($request,$challanId)
    {
        Stock::create([
            'supplier_id'        =>$request->supplier_id,
            'item_id'            =>$request->item,
            'color_id'           =>$request->color_id,
            'size_id'            =>$request->size_id,
            'country_id'         =>$request->country_id,
            'unit_qty'           =>$request->unit_qty,
            'sub_unit_qty'       =>$request->sub_unit_qty,
            'purchase_price'     =>$request->purchase, 
            'branch_id'          => auth()->user()->branch_id,
            'serial'             =>$request->serial,
            'challan'            =>$challanId,

        ]);
    }   

    public static function updateStock($request,$stock)
    {
        $stock->update([
            'supplier_id'        =>$request->supplier_id,
            'item_id'            =>$request->item,
            'color_id'           =>$request->color_id,
            'size_id'            =>$request->size_id,
            'country_id'         =>$request->country_id,
            'unit_qty'           =>$request->unit_qty,
            'sub_unit_qty'       =>$request->sub_unit_qty,
            'purchase_price'     =>$request->purchase, 
            'branch_id'          => auth()->user()->branch_id,
            'serial'             =>$request->serial,
            'challan'            =>$request->challan,
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


}

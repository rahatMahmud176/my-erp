<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Stock extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public static function newStock($request)
    {
        Stock::create([
            'item_id'            =>$request->item,
            'color_id'           =>$request->color,
            'size_id'            =>$request->size,
            'country_id'         =>$request->country,
            'qty'                =>$request->qty,
            'purchase_price'     =>$request->purchase,
            'wholesale_price'    =>$request->wholesale,
            'price'              =>$request->price,
            'branch_id'          => auth()->user()->branch_id,
            'serial'             =>$request->serial,
        ]);
    }   

    public static function updateStock($request,$stock)
    {
        $stock->update([
            'item_id'            =>$request->item_id,
            'color_id'           =>$request->color_id,
            'size_id'            =>$request->size_id,
            'country_id'         =>$request->country_id,
            'qty'                =>$request->qty,
            'purchase_price'     =>$request->purchase_price,
            'wholesale_price'    =>$request->wholesale_price,
            'price'              =>$request->price,
            'branch_id'          =>$request->branch_id,
            'serial'             =>$request->serial,
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

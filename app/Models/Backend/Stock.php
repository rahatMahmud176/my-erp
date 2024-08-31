<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Stock extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function productHistoryBranch()
    {
       return Stock::select('id','supplier_id','serial','item_id','created_at')
                ->with([
                    'item:id,name',
                    'supplier:id,name', 
                ])
                ->where('branch_id', auth()->user()->branch_id)
                ->orderBy('id','desc')
                ->paginate('15');
    }
    public static function searchProductHistoryBranch($string)
    {
       return Stock::select('id','supplier_id','serial','item_id','created_at')
                ->with([
                    'item:id,name',
                    'supplier:id,name', 
                ])
                ->where('serial','LIKE', '%'.$string.'%')
                ->where('branch_id', auth()->user()->branch_id)
                ->orderBy('id','desc')
                ->paginate('15');
    }

    public static function branchStocks()
    {
        return Stock::where('branch_id',auth()->user()->branch_id)
                    ->where('unit_qty','!=',0)
                        ->get();
    }
    public static function searchResult($searchKey)
    {
        return Stock::where('branch_id',auth()->user()->branch_id)
                    ->where('serial', 'LIKE', '%'.$searchKey.'%')
                    ->where('unit_qty','!=',0)
                    ->get();
    }

    public static function allStocks()
    {
        return Stock::orderBy('id','DESC')->get();
    }








    public static function newStock($request,$challanId,$supplier_id)
    {   

        Stock::create([
            'supplier_id'        =>$supplier_id,
            'supplier_id'        =>1,
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

    public static function newStockWithSerial($request,$challanId,$serial,$supplier_id)
    {  
        // dd($serial);
        Stock::create([
            'supplier_id'        =>$supplier_id,
            // 'supplier_id'        =>1,
            'item_id'            =>$request['item'],
            'color_id'           =>$request['color_id'] ?? 1,
            'size_id'            =>$request['size_id'] ?? 1,
            'country_id'         =>$request['country_id'] ?? 1, 
            'sub_unit_qty'       =>$request['sub_unit_qty'] ?? 0,
            'purchase_price'     =>$request['purchase'], 
            'branch_id'          => auth()->user()->branch_id,
            'challan_id'         =>$challanId, 
            'serial'             =>$serial,
        ]); 
    }   
 

public static function decrees($sale)
{
    $stock = Stock::find($sale['id']);
    $stock->unit_qty = $stock->unit_qty - $sale['unit_qty'];
    $stock->sub_unit_qty = $stock->sub_unit_qty - $sale['sub_unit_qty'];
    $stock->save(); 
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
public function supplier()
{
    return $this->belongsTo(Supplier::class);
}   

}

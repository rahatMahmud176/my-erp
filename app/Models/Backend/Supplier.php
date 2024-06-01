<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public static function newSupplier($request)
    {
        Supplier::create([
            'name'          => $request->name,
            'phone_number'  => $request->phone_number,
        ]);
    }

    public static function supplierUpdate($request,$supplier)
    {
        $supplier->update([
            'name'          => $request->name,
            'phone_number'  => $request->phone_number,
        ]);
    }

     








public function challans()
{
    return $this->hasMany(Challan::class);
}



}

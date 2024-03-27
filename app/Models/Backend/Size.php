<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $guarded =  ['id']; 
 
    public static $size;


    public static function newSize($request)
    {
        Size::create([
            'name' => $request->name,
        ]); 
    }   

    public static function sizeUpdate($request,$size)
    {
        $size->update([
            'name'  => $request->name,
        ]);
    }
}

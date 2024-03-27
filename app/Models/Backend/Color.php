<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $guarded =  ['id']; 
 
    public static $color;


    public static function newColor($request)
    {
        Color::create([
            'name' => $request->name,
        ]); 
    }   

    public static function colorUpdate($request,$color)
    {
        $color->update([
            'name'  => $request->name,
        ]);
    }

}

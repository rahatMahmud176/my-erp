<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory; 
    protected $guarded =  ['id'];  
    public static $unit;


    public static function allUnit()
    {
        return Unit::orderBy('id','desc')->get();
    }  

    public static function newUnit($request)
    {
        Unit::create([
            'name' => $request->name,
        ]); 
    }   

    public static function unitUpdate($request,$unit)
    {
        $unit->update([
            'name'  => $request->name,
        ]);
    }

}

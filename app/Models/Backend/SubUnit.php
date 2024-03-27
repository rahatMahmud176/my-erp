<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubUnit extends Model
{
    use HasFactory;

    protected $guarded =  ['id']; 
 
    public static $subUnit;


    public static function newSubUnit($request)
    {
        SubUnit::create([
            'name' => $request->name,
        ]); 
    }   

    public static function subUnitUpdate($request,$subUnit)
    {
        $subUnit->update([
            'name'  => $request->name,
        ]);
    }


}

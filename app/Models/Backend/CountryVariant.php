<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryVariant extends Model
{
    use HasFactory;

    protected $guarded =  ['id']; 
 
    public static $countryVariant;


    public static function newCountryVariant($request)
    {
        CountryVariant::create([
            'name' => $request->name,
        ]); 
    }   

    public static function countryVariantUpdate($request,$countryVariant)
    {
        $countryVariant->update([
            'name'  => $request->name,
        ]);
    }
    
}

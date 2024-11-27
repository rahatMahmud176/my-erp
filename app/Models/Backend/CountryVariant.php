<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryVariant extends Model
{
    use HasFactory;

    protected $guarded =  ['id']; 
 
    public static $countryVariant;

  

    public function items()
   {
        return $this->belongsToMany(Item::class);
   } 

    
}

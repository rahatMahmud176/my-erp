<?php

namespace App\Models\Backend;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{ 


    use HasFactory,Sluggable;


    protected $guarded =  ['id']; 

    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public static $brand;


    public static function newBrand($request)
    {
        Brand::create([
            'name' => $request->name,
        ]); 
    }   

    public static function brandUpdate($request,$brand)
    {
        $brand->update([
            'name'  => $request->name,
        ]);
    }

}

<?php

namespace App\Models\Backend;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory, Sluggable;

protected $guarded = ['id'];
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public static $subCategory;


    public static function newSubCategory($request)
    {
        SubCategory::create([
            'name' => $request->name,
            'category_id'  => $request->cat,
        ]); 
    }   

    public static function catUpdate($request,$subCategory)
    {
        $subCategory->update([
            'name'  => $request->name,
            'category_id'  => $request->cat,
        ]);
    }





}

<?php

namespace App\Models\Backend;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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

    public static $category;


    public static function newCategory($request)
    {
        Category::create([
            'name' => $request->name,
        ]); 
    }   

    public static function catUpdate($request,$category)
    {
        $category->update([
            'name'  => $request->name,
        ]);
    }




}

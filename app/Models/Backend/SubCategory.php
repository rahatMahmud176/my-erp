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

  


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }





}

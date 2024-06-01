<?php

namespace App\Models\Backend;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory, Sluggable;


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


protected $guarded = ['id'];




public static function newItem($request)
{
    $item  = Item::create([
        'name'            => $request->name, 
        'brand_id'        => $request->brand, 
        'unit_id'         => $request->unit, 
        'sub_unit_id'     => $request->sub_unit,
        'branch_id'       => auth()->user()->branch_id,
    ]);
    $item->categories()->sync($request->cats);
    $item->countries()->sync($request->countries);
    $item->subCats()->sync($request->sub_cats);
}

public static function updateItem($request, $item = null)
{
    $item->update([
        'name'            => $request->name, 
        'brand_id'        => $request->brand, 
        'unit_id'         => $request->unit, 
        'sub_unit_id'     => $request->sub_unit, 
    ]);
    $item->categories()->sync($request->cats);
    $item->countries()->sync($request->countries);
    $item->subCats()->sync($request->sub_cats);
}

    





    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function subCats()
    {
        return $this->belongsToMany(SubCategory::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function subUnit()
    {
        return $this->belongsTo(SubUnit::class);
    }
    public function countries()
    {
        return $this->belongsToMany(CountryVariant::class);
    }



}

<?php

namespace Database\Seeders;

use App\Models\Backend\Category;
use App\Models\Backend\CountryVariant;
use App\Models\Backend\Item;
use App\Models\Backend\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allCat = Category::all();  
        $allCountries = CountryVariant::all();  
        $allSubCat = SubCategory::all();  

    $item  = Item::updateOrCreate([
            'name'            => 'item',
            'slug'            => 'item-slug',
            'brand_id'        => 1, 
            'unit_id'    => 1, 
            'sub_unit_id'     => 1, 
        ]);
        $item->categories()->sync($allCat->pluck('id'));
        $item->countries()->sync($allCountries->pluck('id'));
        $item->subCats()->sync($allSubCat->pluck('id'));

    $item  = Item::updateOrCreate([
            'name'            => 'item 2',
            'slug'            => 'item-slug-2',   
            'brand_id'        => 1, 
            'unit_id'    => 1, 
            'sub_unit_id'     => 1, 
        ]);
        $item->categories()->sync($allCat->pluck('id'));
        $item->countries()->sync($allCountries->pluck('id'));
        $item->subCats()->sync($allSubCat->pluck('id'));

 
        
    }
}

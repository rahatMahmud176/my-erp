<?php

namespace Database\Seeders;

use App\Models\Backend\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::updateOrCreate([
            'name'  => 'No SubCategory',
            'slug'  => 'no-sub-category',
            'category_id'   => 1,
        ]);
    }
}

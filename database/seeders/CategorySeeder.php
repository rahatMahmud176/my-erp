<?php

namespace Database\Seeders;

use App\Models\Backend\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::updateOrCreate([
            'name'  => 'Uncategorised',
            'slug'  => 'uncategorised',
            'deletable'  => false,
        ]);
    }
}

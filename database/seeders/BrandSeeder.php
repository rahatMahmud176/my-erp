<?php

namespace Database\Seeders;

use App\Models\Backend\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::updateOrCreate([
            'name'  => 'Any Brand'
        ]);
    }
}

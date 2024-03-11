<?php

namespace Database\Seeders;

use App\Models\Backend\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Color::updateOrCreate([
            'name'  => 'Any Color'
        ]);
    }
}

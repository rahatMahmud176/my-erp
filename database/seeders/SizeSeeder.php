<?php

namespace Database\Seeders;

use App\Models\Backend\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Size::updateOrCreate([
            'name'  => 'Any Size'
        ]);
    }
}

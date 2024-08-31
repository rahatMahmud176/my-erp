<?php

namespace Database\Seeders;

use App\Models\Backend\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = ['pcs'];

        foreach ($units as $key => $unit) {
            Unit::updateOrCreate([
                'name'  => $unit,
                'deletable' => false
            ]);
        } 
    }
}

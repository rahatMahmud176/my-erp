<?php

namespace Database\Seeders;

use App\Models\Backend\SubUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subUnits =  ['None'];  
 
        foreach ($subUnits as $key => $subUnit) {
            SubUnit::updateOrCreate([
                'name'  => $subUnit,
                'deletable' => false
            ]);
        }
    }
}

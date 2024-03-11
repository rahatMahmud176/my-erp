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
        $subUnits =  ['None','kg','gm','cm','inch','pcs',
                    'packet','ltr','m','mm','ft','bag',
                    'btl','box','bdl','crtn','dzn','can','rol',
                    'sqf','sqm','tbs'];  
 
        foreach ($subUnits as $key => $subUnit) {
            SubUnit::updateOrCreate([
                'name'  => $subUnit,
            ]);
        }
    }
}

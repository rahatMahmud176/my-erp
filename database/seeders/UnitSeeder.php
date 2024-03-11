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
        $units = ['None','kg','gm','cm','inch','pcs',
                  'packet','ltr','m','mm','ft','bag',
                  'btl','box','bdl','crtn','dzn','can','rol',
                  'sqf','sqm','tbs'];  

        foreach ($units as $key => $unit) {
            Unit::updateOrCreate([
                'name'  => $unit,
            ]);
        } 
    }
}

<?php

namespace Database\Seeders;

use App\Models\Backend\CountryVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountryVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $countries = ['None','Dubai','Singapore','USA','China','Vietnam','Hongkong'];

        foreach ($countries as $key => $country) {
            CountryVariant::updateOrCreate([
                'name'  => $country,
            ]);
        }
        
    }
}

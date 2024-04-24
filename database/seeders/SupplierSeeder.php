<?php

namespace Database\Seeders;

use App\Models\Backend\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::updateOrCreate([
            'name'          => 'Supplier 01',
            'phone_number'  => '015********',
        ]);
    }
}

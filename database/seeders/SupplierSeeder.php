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
            'name'          => 'Demo supplier',
            'phone_number'  => '015********',
            'branch_id'     => 1,
            'deletable'     => false,
        ]);
        
        // Supplier::updateOrCreate([
        //     'name'          => 'Jamuna supplier',
        //     'phone_number'  => '015********',
        //     'branch_id'     => 2,
        //     'deletable'     => false,
        // ]);
    }
}

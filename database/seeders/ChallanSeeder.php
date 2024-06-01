<?php

namespace Database\Seeders;

use App\Models\Backend\Challan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChallanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Challan::create([
            'supplier_id'  => 1, 
            'branch_id'    => 1,
            'deletable'    => false,
        ]);
    }
}

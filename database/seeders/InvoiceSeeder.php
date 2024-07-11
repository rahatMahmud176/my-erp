<?php

namespace Database\Seeders;

use App\Models\Backend\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Invoice::create([
            'customer_id'  =>1,
            'branch_id'    =>1,
            'total'        =>0,
            'deletable'    =>false,
    ]); 
    }
}

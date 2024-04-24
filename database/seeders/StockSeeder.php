<?php

namespace Database\Seeders;

use App\Models\Backend\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        Stock::updateOrCreate([
            'item_id'           => 1,
            'color_id'          => 1,
            'size_id'           => 1,
            'country_id'        => 1,
            'qty'               => 1,
            'purchase_price'    => 1,
            'wholesale_price'   => 1,
            'price'             => 1,
            'branch_id'         => 1,
        ]);

        Stock::updateOrCreate([
            'item_id'           => 1,
            'color_id'          => 1,
            'size_id'           => 1,
            'country_id'        => 1,
            'qty'               => 1,
            'purchase_price'    => 15,
            'wholesale_price'   => 15,
            'price'             => 15,
            'branch_id'         => 2,
        ]);






    }
}

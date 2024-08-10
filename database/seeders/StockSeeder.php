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
         
        // Stock::updateOrCreate([ 
        //     'supplier_id'       => 1,
        //     'item_id'           => 1,
        //     'color_id'          => 1,
        //     'size_id'           => 1,
        //     'country_id'        => 1,
        //     'unit_qty'          => 10,
        //     'purchase_price'    => 1,
        //     'wholesale_price'   => 1,
        //     'price'             => 1,
        //     'branch_id'         => 1,
        //     'challan_id'        => 1,
        // ]);

        // Stock::updateOrCreate([
        //     'supplier_id'       => 1,
        //     'item_id'           => 2,
        //     'color_id'          => 1,
        //     'size_id'           => 1,
        //     'country_id'        => 1,
        //     'unit_qty'          => 15,
        //     'purchase_price'    => 15,
        //     'wholesale_price'   => 15,
        //     'price'             => 15,
        //     'branch_id'         => 2,
        //     'challan_id'        => 1,
        // ]);

        // Stock::updateOrCreate([
        //     'supplier_id'       => 1,
        //     'item_id'           => 3,
        //     'color_id'          => 1,
        //     'size_id'           => 1,
        //     'country_id'        => 1,
        //     'unit_qty'          => 20,
        //     'purchase_price'    => 15,
        //     'wholesale_price'   => 15,
        //     'price'             => 15,
        //     'branch_id'         => 1,
        //     'challan_id'        => 1,
        // ]);






    }
}

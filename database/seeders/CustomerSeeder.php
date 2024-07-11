<?php

namespace Database\Seeders;

use App\Models\Backend\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Customer::create([
            'name'          => 'Demo Customer 01',
            'phone_number'  => '01580351075',
            'email'         => 'example@gmail.com',
            'address'       => 'Kuakata',
        ]);
        Customer::create([
            'name'          => 'Demo Customer 02',
            'phone_number'  => '01625139805',
            'email'         => 'example2@gmail.com',
            'address'       => 'Coxs Bazar',
        ]);



    }
}

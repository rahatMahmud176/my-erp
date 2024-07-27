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
            'name'          => 'Cell Tech BD',
            'phone_number'  => '01500000000',
            'email'         => 'example@gmail.com',
            'address'       => 'Kuakata',
        ]);  

    }
}

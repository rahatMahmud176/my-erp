<?php

namespace Database\Seeders;

use App\Models\Backend\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
                'company_name'          => 'Company Name',
                'company_phone_number'  => '015*****',
                'company_address'       => 'Company Address',
                'color'                 => true,
                'size'                  => true,
                'country'               => true,
                'sub_unit'              => true,
                'serial_number'         => true, 
        ]);
    }
} 
<?php

namespace Database\Seeders;

use App\Models\Backend\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::updateOrCreate([
            'ac_title'  => 'Due',
            'ac_no'     => '-',
            'branch_id' => 1,
            'deletable' => false,
        ]);
        Account::updateOrCreate([
            'ac_title'  => 'Cash',
            'ac_no'     => '-',
            'branch_id' => 1,
            'deletable' => false,
        ]);
        Account::updateOrCreate([
            'ac_title'  => 'Cheque',
            'ac_no'     => '-',
            'branch_id' => 1,
            'deletable' => false,
        ]);
        Account::updateOrCreate([
            'ac_title'  => 'City Bank',
            'ac_no'     => '5465465465454',
            'branch_id' => 1,
        ]);
        Account::updateOrCreate([
            'ac_title'  => 'Nagad 75',
            'ac_no'     => '01580351075',
            'branch_id' => 1,
        ]);
    }
}

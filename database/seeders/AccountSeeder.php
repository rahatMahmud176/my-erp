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
            'ac_title'  => 'Bank',
            'ac_no'     => '5465465465454',
            'branch_id' => 1,
        ]);
        Account::updateOrCreate([
            'ac_title'  => 'Nagad',
            'ac_no'     => '-',
            'branch_id' => 1,
        ]);
        Account::updateOrCreate([
            'ac_title'  => 'Bkash',
            'ac_no'     => '-',
            'branch_id' => 1,
        ]);
        Account::updateOrCreate([
            'ac_title'  => 'Rocket',
            'ac_no'     => '-',
            'branch_id' => 1,
        ]);


        // ------------------for jamuna branch ------------------------------------------------------


        Account::updateOrCreate([
            'ac_title'  => 'Due',
            'ac_no'     => '-',
            'branch_id' => 2,
            'deletable' => false,
        ]);
        Account::updateOrCreate([
            'ac_title'  => 'Cash',
            'ac_no'     => '-',
            'branch_id' => 2,
            'deletable' => false,
        ]);
        Account::updateOrCreate([
            'ac_title'  => 'Cheque',
            'ac_no'     => '-',
            'branch_id' => 2,
            'deletable' => false,
        ]);
        Account::updateOrCreate([
            'ac_title'  => 'Bank',
            'ac_no'     => '5465465465454',
            'branch_id' => 2,
        ]);
        Account::updateOrCreate([
            'ac_title'  => 'Nagad',
            'ac_no'     => '-',
            'branch_id' => 2,
        ]);
        Account::updateOrCreate([
            'ac_title'  => 'Bkash',
            'ac_no'     => '-',
            'branch_id' => 2,
        ]);
        Account::updateOrCreate([
            'ac_title'  => 'Rocket',
            'ac_no'     => '-',
            'branch_id' => 2,
        ]);



    }
}

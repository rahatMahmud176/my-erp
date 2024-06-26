<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    $superadminRole = Role::where('slug','super-admin')->first();
        User::updateOrCreate([
            'name'       => 'Super Admin',
            'branch_id'  => 1,
            'role_id'    => $superadminRole->id,
            'email'      => 'superadmin@gmail.com',
            'password'   => Hash::make('12345678'),
        ]);

    $adminRole = Role::where('slug','admin')->first();
        User::updateOrCreate([
            'name'     => 'Admin',
            'branch_id'  => 1,
            'role_id'  => $adminRole->id,
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

    $EmployeeRole = Role::where('slug','employee')->first();
        User::updateOrCreate([
            'name'     => 'Employee 01',
            'branch_id'  => 2,
            'role_id'  => $EmployeeRole->id,
            'email'    => 'jamuna@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        
    $userRole = Role::where('slug','user')->first();
        User::updateOrCreate([
            'name'    => 'user',
            'role_id' => $userRole->id,
            'email'   => 'user@gmail.com',
            'password'=> Hash::make('12345678'),
        ]);



    }
}

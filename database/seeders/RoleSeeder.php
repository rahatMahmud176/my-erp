<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
    $superAdminPermissions = Permission::all(); 
        Role::updateOrCreate([
            'name'      => 'Super Admin',
            'slug'      => 'super-admin',
            'deletable' =>  false,
        ])->permissions()->sync($superAdminPermissions->pluck('id'));

        Role::updateOrCreate([
            'name'      => 'Admin',
            'slug'      => 'admin',
            'deletable' =>  false,
        ])->permissions()->sync($superAdminPermissions->pluck('id'));

    $EmployeePermissions = Permission::where('slug','LIKE','utility%')
                                            ->orWhere('slug','LIKE','dashboard%')
                                            ->orWhere('slug','LIKE','item%')
                                            ->orWhere('slug','LIKE','stock%')
                                            ->get();
        Role::updateOrCreate([
            'name'      => 'Employee',
            'slug'      => 'employee',
            'deletable' =>  false,
        ])->permissions()->sync($EmployeePermissions->pluck('id'));
 


        Role::updateOrCreate([
                    'name'      => 'User',
                    'slug'      => 'user',
                    'deletable' =>  false,
                ]); 
    }
}

<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        $dashboardModule = Module::updateOrCreate(['name'=>'Dashboard Module']);
                    Permission::updateOrCreate([
                        'module_id'  => $dashboardModule->id,
                        'name'       => 'Dashboard Access',
                        'slug'       => 'dashboard.index'
                    ]); 


        $roleModule = Module::updateOrCreate(['name'=>'Role Module']);
                    Permission::updateOrCreate([
                        'module_id'  => $roleModule->id,
                        'name'       => 'Role View',
                        'slug'       => 'role.index'
                    ]); 
                    Permission::updateOrCreate([
                        'module_id'  => $roleModule->id,
                        'name'       => 'Role Create',
                        'slug'       => 'role.create'
                    ]);  
                    Permission::updateOrCreate([
                        'module_id'  => $roleModule->id,
                        'name'       => 'Role Edit',
                        'slug'       => 'role.edit'
                     ]); 
                    Permission::updateOrCreate([
                        'module_id'  => $roleModule->id,
                        'name'       => 'Role Delete',
                        'slug'       => 'role.delete'
                     ]);  

        $userModule = Module::updateOrCreate(['name'=>'User Module']);
                    Permission::updateOrCreate([
                        'module_id'  => $userModule->id,
                        'name'       => 'User View',
                        'slug'       => 'user.index'
                    ]); 
                    Permission::updateOrCreate([
                        'module_id'  => $userModule->id,
                        'name'       => 'User Create',
                        'slug'       => 'user.create'
                    ]);  
                    Permission::updateOrCreate([
                        'module_id'  => $userModule->id,
                        'name'       => 'User Edit',
                        'slug'       => 'user.edit'
                     ]); 
                    Permission::updateOrCreate([
                        'module_id'  => $userModule->id,
                        'name'       => 'User Delete',
                        'slug'       => 'user.delete'
                     ]);  


                    

    }
}

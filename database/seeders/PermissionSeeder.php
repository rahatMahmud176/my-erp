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


            $utilityModule = Module::updateOrCreate(['name'=>'Utility Module']);
                     Permission::updateOrCreate([
                         'module_id'  => $utilityModule->id,
                         'name'       => 'Utility View',
                         'slug'       => 'utility.index'
                     ]); 
                     Permission::updateOrCreate([
                         'module_id'  => $utilityModule->id,
                         'name'       => 'Utility Create',
                         'slug'       => 'utility.create'
                     ]);  
                     Permission::updateOrCreate([
                         'module_id'  => $utilityModule->id,
                         'name'       => 'Utility Edit',
                         'slug'       => 'utility.edit'
                      ]); 
                     Permission::updateOrCreate([
                         'module_id'  => $utilityModule->id,
                         'name'       => 'Utility Delete',
                         'slug'       => 'utility.delete'
                      ]);  


          $itemModule = Module::updateOrCreate(['name'=>'Item Registered Module']);
                    Permission::updateOrCreate([
                        'module_id'  => $itemModule->id,
                        'name'       => 'Item View',
                        'slug'       => 'item.index'
                    ]); 
                    Permission::updateOrCreate([
                        'module_id'  => $itemModule->id,
                        'name'       => 'Item Create',
                        'slug'       => 'item.create'
                    ]);  
                    Permission::updateOrCreate([
                        'module_id'  => $itemModule->id,
                        'name'       => 'Item Edit',
                        'slug'       => 'item.edit'
                     ]); 
                    Permission::updateOrCreate([
                        'module_id'  => $itemModule->id,
                        'name'       => 'Item Delete',
                        'slug'       => 'item.delete'
                     ]);  


          $stockModule = Module::updateOrCreate(['name'=>'Stock Module']);
                    Permission::updateOrCreate([
                        'module_id'  => $stockModule->id,
                        'name'       => 'Stock View',
                        'slug'       => 'stock.index'
                    ]); 
                    Permission::updateOrCreate([
                        'module_id'  => $stockModule->id,
                        'name'       => 'Stock Create',
                        'slug'       => 'stock.create'
                    ]);  
                    Permission::updateOrCreate([
                        'module_id'  => $stockModule->id,
                        'name'       => 'Stock Edit',
                        'slug'       => 'stock.edit'
                     ]); 
                    Permission::updateOrCreate([
                        'module_id'  => $stockModule->id,
                        'name'       => 'Stock Delete',
                        'slug'       => 'stock.delete'
                     ]);  
  
    }
}

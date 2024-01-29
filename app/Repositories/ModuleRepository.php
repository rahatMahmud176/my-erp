<?php
namespace App\Repositories;

use App\Contracts\ModuleInterface;
use App\Models\Module;

class ModuleRepository implements ModuleInterface
{
    public function all()
    {   
       return Module::all();
    }
}
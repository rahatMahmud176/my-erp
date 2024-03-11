<?php

namespace App\Repositories;

use App\Contracts\RoleInterface;
use App\Models\Role;

class RoleRepository implements RoleInterface
{
    public function all()
    {
       return Role::all();
    }
    public function create($request)
    {
        Role::create($request);
    }
    public function update($request,$role)
    {
        Role::updateRole($request,$role);
    }
}
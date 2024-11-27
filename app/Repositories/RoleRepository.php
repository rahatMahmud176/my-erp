<?php

namespace App\Repositories;

use App\Contracts\RoleInterface;
use App\Models\Role;
use Str;

class RoleRepository implements RoleInterface
{
    public function all()
    {
       return Role::all();
    }

    public function create($request)
    {
       Role::updateOrCreate([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name),
        ])->permissions()->sync($request->input('permissions'));
    }


    public function update($request,$role)
    {
        $role->update([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name),
        ]);
        $role->permissions()->sync($request->input('permissions'));
    }
}
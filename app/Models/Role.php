<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Role extends Model
{
    use HasFactory; 
    protected $guarded =['id'];


    public static function create($request)
    {
        Role::updateOrCreate([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name),
        ])->permissions()->sync($request->input('permissions'));
    }


    public static function updateRole($request,$role)
    {
        $role->update([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name),
        ]);
        $role->permissions()->sync($request->input('permissions'));
    }



public function permissions()
{
    return $this->belongsToMany(Permission::class);
}
public function users()
{
    return $this->hasMany(User::class);
}



}

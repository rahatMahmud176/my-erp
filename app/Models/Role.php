<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Role extends Model
{
    use HasFactory; 
    protected $guarded =['id'];
 
 


public function permissions()
{
    return $this->belongsToMany(Permission::class);
}
public function users()
{
    return $this->hasMany(User::class);
}



}

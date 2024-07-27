<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

public static function branchAccounts()
{
    return Account::where('branch_id', auth()->user()->branch_id)->get();
}

public static function allAccounts()
{
    return Account::get();
}




public function transitions()
{
    return $this->hasMany(Transition::class);
}



    
}

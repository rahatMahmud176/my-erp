<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
 



public function challans()
{
    return $this->hasMany(Challan::class);
}

public function transitions()
{
    return $this->hasMany(SupplierTransition::class);
}



}

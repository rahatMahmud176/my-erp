<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    use HasFactory;

    protected $guarded = ['id'];










    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }   







}

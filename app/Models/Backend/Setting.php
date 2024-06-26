<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public static function updateSetting($request,$setting)
    {
            $setting->update([
                'color'                 => $request->color ?? '0',
                'size'                  => $request->size ?? '0',
                'country'               => $request->country ?? '0',
                'sub_unit'              => $request->sub_unit ?? '0',
                'serial_number'         => $request->serial_number ?? '0',
                'qty_manage_by_serial'  => $request->qty_manage_by_serial ?? '0',
            ]);
    }









}

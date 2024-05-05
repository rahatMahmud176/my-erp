<?php
namespace App\Repositories;

use App\Contracts\SettingInterface;
use App\Models\Backend\Setting;

class SettingRepository implements SettingInterface
{
    public function getSetting()
    {
       return Setting::orderBy('id','desc')->first();
    }
    public function updateSetting($request,$setting)
    {
        Setting::updateSetting($request,$setting);
    }
}
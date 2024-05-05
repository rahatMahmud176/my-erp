<?php

namespace App\Contracts;

interface SettingInterface
{
    public function getSetting();
    public function updateSetting($request,$setting);
}
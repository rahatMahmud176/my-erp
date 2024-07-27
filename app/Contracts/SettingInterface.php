<?php

namespace App\Contracts;

interface SettingInterface
{
    public function companyInfo();
    public function getSetting();
    public function updateSetting($request,$setting);
}
<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\SettingInterface;
use App\Http\Controllers\Controller;
use App\Models\Backend\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public $setting;
    
    public function __construct(SettingInterface $settingInterface) {
        $this->setting = $settingInterface;
    }


    public function index()
    {
       $setting = $this->setting->getSetting();
        
        return view('backend.setting.form',compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $this->setting->updateSetting($request,$setting); 
        notify('Updated Successfully','Updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}

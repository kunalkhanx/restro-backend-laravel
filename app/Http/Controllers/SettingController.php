<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function store(Setting $setting, Request $request){
        if(!$setting){
            return response('', 404);
        }
        $setting->setting_value = $request->setting_value;
        $setting->save();
        return response('', 201);
    }

    public function storBulk(Request $request){
        $data = $request->only(['PAYMENT_METHODS', 'SGST', 'CGST']);
        foreach($data as $key => $value){
            if($key == 'PAYMENT_METHODS'){
                $value = json_encode(explode(',', $value));
            }
            Setting::where('setting_key', $key)->update(['setting_value' => $value]);
        }
        return response('', 201);
    }

    public function get($key){
        $setting = Setting::where('scope', 'GLOBAL')->where('setting_key', $key)->first();
        if(!$setting){
            return response('', 404);
        }
        return response()->json($setting);
    }

    public function all(){
        $settings = Setting::where('scope', 'GLOBAL')->get();
        $result = [];
        foreach($settings as $setting){
            $result[$setting['setting_key']] = $setting;
        }
        return response()->json($result);
    }
}

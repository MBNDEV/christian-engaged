<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    public function index(){
        $setting = Setting::get();
        $data['content'] = view('admin.setting.index', compact('setting'));
        return view('layouts.template', $data);
    }
    
    public function update(Request $request){
        $setting = Setting::get();
        foreach ($setting as $key => $value) {
        	if(isset($request['start_'.$value->id]) && isset($request['end_'.$value->id]) && isset($request['cost_'.$value->id])){
        		
        		Setting::where('id', $value->id)->update(['start_range' => $request['start_'.$value->id],'end_range' => $request['end_'.$value->id],'cost' => $request['cost_'.$value->id]]);
        	}
        }
        return redirect('/manage/setting')->withSuccess('Shipping Detail Save Successfully!');
    }
}

<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use Illuminate\Support\Str;
class ConfigController extends Controller
{
    public function index(){

        $config= Config::find(1);
        return view('back.config.index',compact('config'));
    }


    public function update(Request $request){

        $config=Config::find(1);
        $config->title=$request->title;
        $config->instagram=$request->instagram;
        $config->facebook=$request->facebook;
        $config->youtube=$request->youtube;
        $config->X=$request->x;
        $config->github=$request->github;
        $config->linkedin=$request->linkedin;
        $config->active=$request->active;
        $config->title=$request->title;

        if ($request->hasFile('logo')){
            $logo=Str::slug($request->title).'-logo.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('images'),$logo);
            $config->logo='images/'.$logo;

        }

        if ($request->hasFile('favicon')){
            $favicon=Str::slug($request->title).'-favicon.'.$request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('images'),$favicon);
            $config->favicon='images/'.$favicon;

        }

        $config->save();
        flash()->success('Başarıyla gönderildi');

        return redirect()->back();
    }


}

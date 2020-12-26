<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\ImageUpload;

class AccountEditorController extends Controller
{
    public function fileCreate()
    {
        if(Auth::check()) {
            return view('accounteditor');
        }
        else{
            return view('home');
        }
    }

    public function fileStore(Request $request)
    {
        if($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('profilepics'), $imageName);
            $this->lastname=$imageName;
        }
        else {

            if(!is_null($request["name"])){
                Auth::user()["name"] = $request["name"];
            }

            if(!is_null($request["filename"])) {
                Auth::user()["profilefile"] = $request["filename"];
            }

            if(!is_null($request["about"])) {
                Auth::user()["about"] = $request["about"];
            }
            else{
                Auth::user()["about"] = "";
            }

            if($request["showmail"]=="true"){
                Auth::user()["showmail"] = 1;
            }
            else{
                Auth::user()["showmail"] = 0;
            }

            if(!is_null($request["location"])) {
                Auth::user()["location"] = $request["location"];
            }
            else{
                Auth::user()["location"] = "";
            }

            if($request["showloc"]=="true"){
                Auth::user()["showloc"] = 1;
            }
            else{
                Auth::user()["showloc"] = 0;
            }


            Auth::user()->save();


            return \Redirect::to('/account');
        }

    }


}

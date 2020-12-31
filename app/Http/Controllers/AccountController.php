<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\ImageUpload;

class AccountController extends Controller
{
    public function show($user)
    {
        if(Auth::check() and Auth::user()['username']==$user){
            return redirect("/account");
        }

        $user = DB::table('users')->where('username', $user)->first();
        if($user) {
            return view('useraccount')->with([
                'username' => $user->username,
                'name' => $user->name,
                'about' => $user->about,
                'email' => $user->email,
                'showmail' => $user->showmail,
                'location' => $user->location,
                'showloc' => $user->showloc,
                'profilefile' => $user->profilefile
            ]);
        }
        else{
            return abort(404);
        }
    }
    public function myposts($user)
    {
        $user = DB::table('users')->where('username', $user)->first();
        $imageupload = DB::table('image_uploads')->where('user', $user->username)->pluck("filename");
        if($user) {
            return view('myposts')->with([
                'username' => $user->username,
                'name' => $user->name,
                'works' => $imageupload
            ]);
        }
        else{
            return abort(404);
        }
    }
}

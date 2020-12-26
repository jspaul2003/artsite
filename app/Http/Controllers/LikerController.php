<?php

namespace App\Http\Controllers;

use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\ImageUpload;

class LikerController extends Controller
{
    public function like($postid)
    {
        DB::table('image_uploads')->where('id',$postid)->increment('likes',1);

        $post = DB::table('image_uploads')->where('id',$postid)->first();
        Auth::user()->lposts()->sync([$postid,]);
        return \Redirect::to('/art/'.$post->id);
    }
    public function unlike($postid)
    {
        DB::table('image_uploads')->where('id',$postid)->decrement('likes',1);

        $post = DB::table('image_uploads')->where('id',$postid)->first();
        DB::table('image_upload_user')
            ->where('image_upload_id', '=', $postid)
            ->where('user_id','=',Auth::id())
            ->delete();
        return \Redirect::to('/art/'.$post->id);
    }
}

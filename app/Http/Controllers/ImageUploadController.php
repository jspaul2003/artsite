<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ImageUpload;

class ImageUploadController extends Controller
{
    var $lastname;

    public function fileCreate()
    {
        if(Auth::check()) {
            return view('userupload');
        }
        else{
            return view('main');
        }
    }

    public function fileStore(Request $request)
    {
        if($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $this->lastname=$imageName;
        }
        else {
            $imageUpload = new ImageUpload();

            $imageUpload->filename = $request['filename'];

            $imageUpload->description = $request['description'];
            $imageUpload->title = $request['title'];
            $imageUpload->user =  Auth::user()->toArray()['username'];
            $imageUpload->tags = $request['tags'];
            $imageUpload->views=0;
            $imageUpload->likes=1;
            $imageUpload->save();
            $this->clock = 0;

            return view('main');
        }

    }

    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        ImageUpload::where('filename',$filename)->delete();
        $path=public_path().'/images/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
}

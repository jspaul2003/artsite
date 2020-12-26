<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            return view('home');
        }
    }

    public function fileStore(Request $request)
    {
        header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0, max-age=0');
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: text/html');
        //dump($request);
        //dump($request->hasFile('file'));
        //dump((file_exists(public_path().'/images/'.$request['filename'])));
        //dump($request['filename']);
        //dump(file_exists(public_path().'/images/'.$request['filename']));
        if($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $this->lastname=$imageName;
        }
        else {
            if(strlen(strip_tags($request['title']))>0 and ((file_exists(public_path().'/images/'.$request['filename'])) or !(strlen(strip_tags($request['description']))==0)) ){
                $imageUpload = new ImageUpload();

                $imageUpload->filename = $request['filename'];

                $imageUpload->description = $request['description'];
                $imageUpload->title = $request['title'];
                $imageUpload->user = Auth::user()->toArray()['username'];

                $imageUpload->user()->associate(Auth::user()); # <--- Associate the user with post

                $imageUpload->tags = $request['tags'];
                $imageUpload->views = 0;
                $imageUpload->likes = 1;
                $imageUpload->save();
                $this->clock = 0;

                #liking the post
                $post = DB::table('image_uploads')->where('filename', $request['filename'])->first();
                Auth::user()->lposts()->sync([$post->id,]);

                return redirect('/art/' . $post->id);
            }
            elseif(strlen(strip_tags($request['title']))>0){
                $error="Whoops, you'll need a description or an image";
                $error_data=[$request['filename'],$request['description'],$request['title'],$request['tags']];


                return view("userupload")->with([
                    'error'=>$error,
                    'error_data'=>$error_data
                ]);
            }
            else{
                /*$path=public_path().'/images/'.$request['filename'];
                if (file_exists($path)) {
                    unlink($path);
                }*/
                $error="Whoops, you'll need a title";
                $error_data=[$request['filename'],$request['description'],$request['title'],$request['tags']];
                //if (file_exists($path)) {
                  //  unlink($path);
                    //array_push($errors, "Please upload your image again");
                //}
                return view("userupload")->with([
                    'error'=>$error,
                    'error_data'=>$error_data
                ]);
            }
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

    public function show($id)
    {
        DB::table('image_uploads')->where('id', $id)->increment('views',1);
        $post = DB::table('image_uploads')->where('id', $id)->first();
        if($post) {
            return view('post')->with([
                'title' => $post->title,
                'filename' => $post->filename,
                'description' => $post->description,
                'user' => $post->user,
                'tags' => $post->tags,
                'views' => $post->views,
                'likes' => $post->likes,
                'createdat' => $post->created_at,
                'fileid' => $post->id
            ]);
        }
        else{
            return abort(404);
        }
    }
}

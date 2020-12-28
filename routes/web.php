<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::post('/r', 'chatcontroller@store');


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\ImageUpload;

Route::get('image/upload','ImageUploadController@fileCreate');
Route::post('image/upload/store','ImageUploadController@fileStore');
Route::post('image/delete','ImageUploadController@fileDestroy');

Route::get('account/edit','AccountEditorController@fileCreate');
Route::post('account/edited/store','AccountEditorController@fileStore');
Route::post('account/delete','AccountEditorController@fileDestroy');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

Route::get('/', function () {
    return redirect("/home");
});
Route::get('/welcome', function () {
    return redirect("/home");
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{page}/{sort}', 'HomeController@allthereis')->name('home');


Route::post('/art/like/{postid}', 'LikerController@like');
Route::post('/art/unlike/{postid}', 'LikerController@unlike');


Route::get('/art/{id}', 'ImageUploadController@show');
Route::get('/account', function(){
    return view('account');
});

Route::get('/people/{user}', 'AccountController@show');
Route::get('/people/{user}/posts', 'AccountController@myposts');

Route::get('/search', 'SearchController@search');


Route::get('/usersearch/{page}/{sort}/{searchTerm}', 'SearchController@usersearch');
Route::get('/postsearch/{page}/{sort}/{searchTerm}', 'SearchController@postsearch');

Route::get('/usersearch/{page}/{sort}', 'SearchController@usersearch1');
Route::get('/postsearch/{page}/{sort}', 'SearchController@postsearch1');

Route::get('/art/{id}/update', function($id){
    $post = DB::table('image_uploads')->where('id', $id)->first();
    if(Auth::check() and Auth::user()['username']==$post->user){
    return view('editpost')->with([
        'title' => $post->title,
        'filename' => $post->filename,
        'description' => $post->description,
        'user' => $post->user,
        'tags' => $post->tags,
        'views' => $post->views,
        'likes' => $post->likes,
        'createdat' => $post->created_at,
        'id' => $id
    ]);
    }
    else{
        return view('home');
    }
});

Route::post('/art/{id}/updater','ImageUploadController@update');
Route::get('/art/{id}/delete','ImageUploadController@delete');


Auth::routes();





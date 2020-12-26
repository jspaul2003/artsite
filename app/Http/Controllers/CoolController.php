<?php

namespace App\Http\Controllers;
use App\ImageUpload;

use Illuminate\Http\Request;

class CoolController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $new = ImageUpload::orderBy("id", 'desc')
            ->take(5)
            ->get();

        $liked = ImageUpload::orderBy("likes", 'desc')
            ->take(5)
            ->get();

        $viewed= ImageUpload::orderBy("views", 'desc')
            ->take(5)
            ->get();


        return view('home')->with([
            'new'=>$new,
            'liked'=>$liked,
            'viewed'=>$viewed
        ]);

    }

    public function allthereis($page, $sort)
    {
        $searchTerm= "";

        #default to new
        $thingtosort="id";

        if($sort=="liked"){
            $thingtosort="likes";
        }
        elseif($sort=="viewed"){
            $thingtosort="views";
        }

        $ImageUploads = ImageUpload::where('title', 'like', '%' . $searchTerm . '%')
            ->orWhere('user', 'like', '%' . $searchTerm . '%')
            ->orWhere('description', 'like', '%' . $searchTerm . '%')
            ->orWhere('tags', 'like', '%' . $searchTerm . '%')
            ->orderBy($thingtosort, 'desc')
            ->paginate(20, ['*'], 'page', $page);

        return view("all")->with([
            'posts'=>$ImageUploads,
            'page'=>$page,
            'request'=>$searchTerm,
            'sort'=>$sort,
            'maxpage'=>$ImageUploads->lastPage()
        ]);
    }

}

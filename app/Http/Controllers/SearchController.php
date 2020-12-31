<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\ImageUpload;


class SearchController extends Controller
{
    public function search(Request $request)
    {
        //dump($request->input('Search'));

        $searchTerm=$request->input('Search');

        //dump($searchTerm);

        $ImageUploads = ImageUpload::where('title', 'like', '%' .$searchTerm. '%')
            ->orWhere('user', 'like', '%' .$searchTerm. '%')
            ->orWhere('description', 'like', '%' .$searchTerm. '%')
            ->orWhere('tags', 'like', '%' .$searchTerm. '%')
            ->get();

        $Users=User::where('username', 'like', '%' .$searchTerm. '%')
            ->orWhere('name', 'like', '%' .$searchTerm. '%')
            ->get();

        //dump($Users[0]->username);

        return view("search")->with([
                'users'=>$Users,
                'posts'=>$ImageUploads,
                'request'=>$searchTerm
            ]);
    }
    public function usersearch($page, $sort, $searchTerm)
    {
        #default to new
        $thingtosort="id";
        if($sort=="posts"){
            $thingtosort="posts";
        }

        $Users = User::where('username', 'like', '%' . $searchTerm . '%')
            ->orWhere('name', 'like', '%' . $searchTerm . '%')
            ->orderBy($thingtosort, 'desc')
            ->paginate(20, ['*'], 'page', $page);

        if($sort=="best") {
            $Users1 = User::where('name', 'like', '%' . $searchTerm . '%');

            $Users = User::where('username', 'like', '%' . $searchTerm . '%')
                ->union($Users1)
                ->paginate(20, ['*'], 'page', $page);
        }

        //dump($searchTerm);
        //dump($Users);

        return view("usersearch")->with([
            'users'=>$Users,
            'page'=>$page,
            'request'=>$searchTerm,
            'sort'=>$sort,
            'maxpage'=>$Users->lastPage()
        ]);
    }

    public function usersearch1($page, $sort)
    {
        $searchTerm="";

        #default to new
        $thingtosort="id";
        if($sort=="posts"){
            $thingtosort="posts";
        }

        $Users = User::where('username', 'like', '%' . $searchTerm . '%')
            ->orWhere('name', 'like', '%' . $searchTerm . '%')
            ->orderBy($thingtosort, 'desc')
            ->paginate(20, ['*'], 'page', $page);

        if($sort=="best") {
            $Users1 = User::where('name', 'like', '%' . $searchTerm . '%');

            $Users = User::where('username', 'like', '%' . $searchTerm . '%')
                ->union($Users1)
                ->paginate(20, ['*'], 'page', $page);
        }




        //dump($Users);
        //dump($Users->lastPage());
        //dump($Users->currentPage());

        return view("usersearch")->with([
            'users'=>$Users,
            'page'=>$page,
            'request'=>$searchTerm,
            'sort'=>$sort,
            'maxpage'=>$Users->lastPage()
        ]);
    }

    public function postsearch($page, $sort, $searchTerm)
    {
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


        if($sort=='best') {
            $ImageUploads1 = ImageUpload::where('user', 'like', '%' . $searchTerm . '%');
            $ImageUploads2 = ImageUpload::where('description', 'like', '%' . $searchTerm . '%');
            $ImageUploads3 = ImageUpload::where('tags', 'like', '%' . $searchTerm . '%');

            $ImageUploads = ImageUpload::where('title', 'like', '%' . $searchTerm . '%')
                ->union($ImageUploads1)
                ->union($ImageUploads2)
                ->union($ImageUploads3)
                ->paginate(20, ['*'], 'page', $page);

        }

        return view("postsearch")->with([
            'posts'=>$ImageUploads,
            'page'=>$page,
            'request'=>$searchTerm,
            'sort'=>$sort,
            'maxpage'=>$ImageUploads->lastPage()
        ]);
    }

    public function postsearch1($page, $sort)
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


        if($sort=='best') {
            $ImageUploads1 = ImageUpload::where('user', 'like', '%' . $searchTerm . '%');
            $ImageUploads2 = ImageUpload::where('description', 'like', '%' . $searchTerm . '%');
            $ImageUploads3 = ImageUpload::where('tags', 'like', '%' . $searchTerm . '%');

            $ImageUploads = ImageUpload::where('title', 'like', '%' . $searchTerm . '%')
                ->union($ImageUploads1)
                ->union($ImageUploads2)
                ->union($ImageUploads3)
                ->paginate(20, ['*'], 'page', $page);

        }

        return view("postsearch")->with([
            'posts'=>$ImageUploads,
            'page'=>$page,
            'request'=>$searchTerm,
            'sort'=>$sort,
            'maxpage'=>$ImageUploads->lastPage()
        ]);
    }
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;

class ac extends Controller
{
    //UPDATE OF NEEDED CRUD FEATURES
    public function create()
    {
        //pass the name and email of user to Account page
        $n = Auth::user()->toArray()['name'];
        $e = Auth::user()->toArray()['email'];

        return view('account')->with([
            'name' => $n,
            'email' => $e,
        ]);
    }

    public function store(Request $request)
    {
        //check if the requests sent were filled by user, if so validate and then change.
        if ($request['name'] != null) {
            $this->validate($request, [
                'name' => 'required|string|max:255',
            ]);
            Auth::user()->name = $request['name'];
        }
        if ($request['email'] != null) {
            $this->validate($request, [
                'email' => 'required|string|email|max:255|unique:users',
            ]);
            Auth::user()->email = $request['email'];
        }
        Auth::user()->save();

        return view('updated');
    }
}
@extends('main')
@push('head')
    <link href='/css/account.css' type='text/css' rel='stylesheet'>
@endpush

@section('data')
    @if(Auth::check())

        <h1>Hi {{Auth::user()["name"]}}!</h1>
        <h2 id="username">{{Auth::user()["username"]}}</h2>

        @if(Auth::user()["profilefile"]!="default1")
            <image class="profilepic" src='/profilepics/{{Auth::user()["profilefile"]}}'>
        @else
            <image class="profilepic" src='/img/default1.png'>
        @endif

        @if(strlen(Auth::user()["about"])>0)
            <h3>About</h3>
            {!! Auth::user()["about"] !!}
        @endif

        <br>

        @if(strlen(Auth::user()["location"])!=0)
            <h4 id="loc"><image class="icon" id="pini" src='/img/pin.png'> {{Auth::user()["location"]}}</h4>
        @endif

        <h4 id="mail"><image class="icon" id="maili" src='/img/mail.jpg'> {{Auth::user()["email"]}}</h4>

        <br>

        <form action="/account/edit">
            <button id="edit_but">Edit Profile</button>
        </form>

        <br>

        <form action="/people/{{Auth::user()["username"]}}/posts">
            <button id="post_but">My Posts</button>
        </form>










    @endif
@endsection

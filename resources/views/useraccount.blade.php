@extends('main')
@push('head')
    <link rel="stylesheet" href="/css/account.css">
@endpush

@section('data')
    <h1>{{$name}}</h1>
    <h2 id="username">{{$username}}</h2>

    @if($profilefile!="default1")
        <image class="profilepic" src='/profilepics/{{$profilefile}}'>
    @else
        <image class="profilepic" src='/img/default1.png'>
    @endif

    @if(strlen($about)>0)
        <h3>About</h3>
        {!! $about !!}
    @endif

    <br>

    @if(strlen($location)!=0 and $showloc)
        <h4 id="loc"><image class="icon" id="pini" src='/img/pin.png'> {{$location}}</h4>
    @endif

    @if($showmail)
        <h4 id="mail"><image class="icon" id="maili" src='/img/mail.jpg'> {{$email}}</h4>
    @endif

     <br>

     <form action="/people/{{$username}}/posts">
         <button id="post_but2">{{$name}}'s Posts</button>
     </form>
@endsection

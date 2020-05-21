@extends('main')
@push('head')
    <link rel="stylesheet" href="/css/post.css">
@endpush

@section('data')
<section id='post'>
    <h1>{!! $title !!}</h1>
    <h3><a id='author' href='/users/{$user}'>{{$user}}</a></h3>
    <br>
    <br>
    <img id= 'art' src='/images/{{$filename}}' alt='{{ $title }}'>
    <br>
    <br>
    <h2>Description</h2>
    {!! $description !!}
    <br>
    <ul id='viewbar'>
        <li><h3 class='bar'>Views<br>{{$views}}</h3></li>
        <li><h3 class='bar'>Likes<br>{{$likes}}</h3></li>
    </ul>
</section>
@endsection
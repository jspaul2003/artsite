@extends('main')
@push('head')
    <link rel="stylesheet" href="/css/post.css">
@endpush

@section('data')
<section id='post'>
    <h1>{!! $title !!}</h1>
    <h3><a id='author' href='/people/{{$user}}'>{{$user}}</a></h3>
    <br>
    <br>
    <img id= 'art' src='/images/{{$filename}}' alt='{{ $title }}'>
    <br>
    <br>
    <h3>Description</h3>
    <h4>{!! $description !!}</h4>
    <br>
    <ul id='viewbar'>
        <li><h3 class='bar'>Views<br>{{$views}}</h3></li>
        <li><h3 class='bar'>Likes<br>{{$likes}}</h3></li>
        <li>
            @if(Auth::check())
                @if(DB::table('image_upload_user')
                    ->where('image_upload_id', '=', $fileid)
                    ->where('user_id','=',Auth::id())
                    ->exists()
                    )
                    <form action="unlike/{{$fileid}}" method="post">
                        {{ csrf_field() }}
                        <h3 class='bar'><input type="image" src="/img/bluethumbsup.png" alt="Submit" name="Like" class="like" id="postlike"/></h3>
                    </form>
                @else
                    <form action="like/{{$fileid}}" method="post">
                        {{ csrf_field() }}
                        <h3 class='bar'><input type="image" src="/img/clearthumbsup.png" alt="Submit" name="Like" class="like" id="postlike"/></h3>
                    </form>
                @endif
            @else
                <form action="/register">
                    <h3 class='bar'><input type="image" src="/img/clearthumbsup.png" alt="Submit" name="Like" class="like" id="postlike"/></h3>
                </form>
            @endif
        </li>
    </ul>
</section>
@endsection

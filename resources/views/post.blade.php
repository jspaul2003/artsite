@extends('main')
@push('head')
    <link rel="stylesheet" href="/css/post.css">
@endpush

@section('data')
<section id='post'>
    <h1 #id="mytitle">{!! $title !!}</h1>

    <h3><a id='author' href='/people/{{$user}}'>{{$user}}</a>

    </h3>
    <br>
    <br>
    <?php
    $path=public_path().'/images/'.$filename;
    ?>
    @if(file_exists($path))
        <img id= 'art' src='/images/{{$filename}}' alt='{{ $title }}'>
    @endif
    @if(strlen(strip_tags($description))>0)
        @if(file_exists($path))
            <br>
            <br>
        <h3>Description</h3>
        @endif
        <h4>{!! $description !!}</h4>
        <br>
    @endif
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
        <li>
            @if(Auth::check() and Auth::user()['username']==$user)
                <h3 class="bar">
                    <div id="editthing" >
                        <ul class="nav nav-pills">
                            <li class="active"><a id='edit' href='/art/{{$fileid}}/update'>Edit<span class="badge"></span></a></li>
                        </ul>
                    </div>
                </h3>
            @endif
        </li>
    </ul>
</section>
@endsection

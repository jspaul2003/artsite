@extends('main')
@push('head')
    <link href='/css/myposts.css' type='text/css' rel='stylesheet'>
@endpush

@section('data')
    @if(Auth::check())
        @if(Auth::user()["username"]==$username)
            <h1 id="page_title">My posts</h1>
        @else
            <h1 id="page_title">{{$username}}'s posts</h1>
        @endif
    @else
        <h1 id="page_title">{{$username}}'s posts</h1>
    @endif


    <div class="grid-container">
        <?php
        foreach ( $works as $file) {
            if ($file !== '.' && $file !== '..' && $file !== '.DS_Store') {
                $files[] = $file;

                echo '
                <div class="gallery">
                    <a href="/art/'. $file . '">
                    <img src="/images/'. $file .'">
                </a>
            </div>';


            }
        }
        if(sizeof($works)==0){

            echo "<br><h4>Pretty Empty :(</h4>";
        }
        ?>
    </div>

@endsection

@extends('main')

@push('head')
    <link rel="stylesheet" href="/css/search.css">
    <link rel="stylesheet" href="/css/home.css">
@endpush

@section('data')
    <div class="list-group" id="userlist">
        <a href="#" class="list-group-item active">
            <h3 class="list-group-item-heading">User Results</h3>
        </a>
        @if(count($users)>0)
            <?php

                for($x=0; $x <= 4; $x++){
                    if($x==(count($users))){
                        break;
                    }
                    if($users[$x]->profilefile!="default1"){
                        echo
                        '
                        <a href="/people/'.$users[$x]->username .'" class="list-group-item">
                        <img class="profilepic" <image class="profilepic" src="/profilepics/'.
                        $users[$x]->profilefile
                        .'">&nbsp;
                        ' .
                            $users[$x]->username .
                            '
                        </a>';
                    }
                    else{
                    echo
                        '
                        <a href="/people/'.$users[$x]->username .'" class="list-group-item">
                        <img class="profilepic" src="/img/default1.png">&nbsp;
                        ' .
                        $users[$x]->username .
                        '</a>';
                    }
                }
            if(count($users)>5){
                echo '<a href="/usersearch/1/best/'. $request .'" class="list-group-item" id="moar">
                    ...
                    </a>';
            }
            ?>
    @else
            <a href="#" class="list-group-item">
                No User Results Could Be Found :(
            </a>
    @endif
    </div>
    <br>
    <br>
    <div class="list-group" id="postlist">
        <a href="#" class="list-group-item active">
            <h3 class="list-group-item-heading">Post Results</h3>
        </a>
        @if(count($posts)>0)
            </div>
            <?php
                $x1=0;
                foreach ( $posts as $f) {
                    $file=$f->filename;
                    if($x1==5){
                        break;
                    }



                    if($file=="default"){
                        $file="default.png";
                            if ($file !== '.' && $file !== '..' && $file !== '.DS_Store') {
                                $files[] = $file;

                                echo '
                        <div class="gallery default1">
                            <a href="/art/'. $f->id . '">
                            <img class="default" src="/images/'. $file .'">
                            <div class="centered">Writing</div>
                            <h5><p class="titus">'
                                    .$f->title.
                                    '</p></h5><p class="titus">'
                                    .$f->user.
                                    '</p></a>
                        </div>';
                                $x1++;


                            }








                        }
                    else{
                        if ($file !== '.' && $file !== '..' && $file !== '.DS_Store') {
                            $files[] = $file;

                            echo '
                        <div class="gallery">
                            <a href="/art/'. $f->id . '">
                            <img src="/images/'. $file .'">
                            <h5><p class="titus">'
                                .$f->title.
                                '</p></h5><p class="titus">'
                                .$f->user.
                                '</p></a>
                        </div>';
                            $x1++;


                        }
                    }
                }
                ?>
        @else
            <a href="#" class="list-group-item">
                No Post Results Could Be Found :(
            </a>
            </div>
        @endif

    @if(count($posts)>5)
        <div id="moarcontainer" class="list-group">
        <a href="/postsearch/1/best/{{$request}}" class="list-group-item" id="moar">
            ...
        </a>
        </div>
        <p></p>
        <p></p>
        <p></p>
        <p></p>
        <p></p>
        <br>
        <br>
    @endif














@endsection

@extends('main')

@push('head')
    <link rel="stylesheet" href="/css/search.css">
@endpush

@section('data')
    <div class="list-group" id="userlist">
        <a href="#" class="list-group-item active">
            <h3 class="list-group-item-heading">User Results</h3>
        </a>
        <?php

        foreach($users as $user){
            if($user->profilefile!="default1"){
                echo
                    '
                        <a href="/people/'.$user->username .'" class="list-group-item">
                        <img class="profilepic" <image class="profilepic" src="/profilepics/'.
                    $user->profilefile
                    .'">&nbsp;
                        ' .
                    $user->username .
                    '
                        </a>';
            }
            else{
                echo
                    '
                        <a href="/people/'.$user->username .'" class="list-group-item">
                        <img class="profilepic" src="/img/default1.png">&nbsp;
                        ' .
                    $user->username .
                    '</a>';
            }
        }

        /*
        $limit=20;
        $starter=0+($page);
        for($x=0; ($x <= $limit-1); $x++){
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
        */
        ?>
        <div id="pagerscontainer">

        <div id="paginationcontainer">
            <ul class="pagination">

                <?php
                if($page==1){
                    echo '<li class="disabled"><a href="#">&laquo;</a></li>';
                }
                else{
                    echo '<li><a href="/usersearch/1/'.$sort.'/'.$request.'">&laquo;</a></li>';
                }
                if($page==1){
                    echo '<li class="disabled"><a href="#">&lsaquo;</a></li>';
                }
                else{
                    echo '<li><a href="/usersearch/'.($page-1).'/'.$sort.'/'.$request.'">&lsaquo;</a></li>';
                }
                for($i=min($page,abs($maxpage-4)); $i<=min(4+$page,$maxpage); $i++){
                    if($i==$page){
                        echo '<li class="active"><a href="/usersearch/'.$i.'/'.$sort.'/'.$request.'">'.$i.'</a></li>';
                    }
                    else{
                        echo '<li><a href="/usersearch/'.$i.'/'.$sort.'/'.$request.'">'.$i.'</a></li>';
                    }
                }


                if($page==$maxpage){
                    echo '<li class="disabled"><a href="#">&rsaquo;</a></li>';
                }
                else{
                    echo '<li><a href="/usersearch/'.($page+1).'/'.$sort.'/'.$request.'">&rsaquo;</a></li>';
                }
                if($page==$maxpage){
                    echo '<li class="disabled"><a href="#">&raquo;</a></li>';
                }
                else{
                    echo '<li><a href="/usersearch/'.$maxpage.'/'.$sort.'/'.$request.'">&raquo;</a></li>';
                }


                ?>


                <li><div class="btn-group">
                        <div class="btn-toolbar">
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Sort By
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/usersearch/1/best/{{$request}}">Best</a></li>
                            <li><a href="/usersearch/1/new/{{$request}}">New</a></li>
                            <li><a href="/usersearch/1/posts/{{$request}}">Posts</a></li>
                            <!--<li><a href="#">Hot</a></li>-->
                        </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>



        </div>


@endsection

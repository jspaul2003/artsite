@extends('main')

@push('head')
    <link rel="stylesheet" href="/css/search.css">
    <link rel="stylesheet" href="/css/home.css">
@endpush

@section('data')
    <p></p>
    <br>
    <p></p>
    <br>
    <p></p>
    <br>
    <p></p>
    <br>
    <p></p>
    <br>
    <p></p>
    <br>

        <h1 id="page_title">
            @if($sort=="viewed")
                Most Viewed
            @elseif($sort=="liked")
                Most Liked
            @else
                New
            @endif
        </h1>

    <p></p>
    <br>
    <p></p>
    <br>



    <div class="grid-container">
        <?php

        $directory = 'images/';

        if (!is_dir($directory)) {
            exit('Invalid directory path');
        }

        foreach ($posts as $fullfile) {
            $file=$fullfile->filename;
            if($file=="default"){
                $file="default.png";
                if ($file !== '.' && $file !== '..' && $file !== '.DS_Store') {
                    $files[] = $file;

                    echo '
                <div class="gallery default1">
                 <a href="/art/'. $fullfile->id . '">
                    <img class="default" src="/images/'. $file .'">
                    <div class="centered">Writing</div>
                </a>
                <h5><div class="titus">'
                        .$fullfile->title.
                        '</div></h5><p class="titus">'
                        .$fullfile->user.
                        '</p></a>
            </div>';
                }


            }
            else{
                if ($file !== '.' && $file !== '..' && $file !== '.DS_Store') {
                    $files[] = $file;

                    echo '
                <div class="gallery">
                 <a href="/art/'. $fullfile->id . '">
                    <img src="/images/'. $file .'">
                </a>
                <h5><div class="titus">'
                        .$fullfile->title.
                        '</div></h5><p class="titus">'
                        .$fullfile->user.
                        '</p></a>
            </div>';
                }
            }
        }

        //var_dump($files);

        ?>

    </div>



    <div id="pagerscontainer">

        <div id="paginationcontainer">
            <ul class="pagination">

                <?php
                if($page==1){
                    echo '<li class="disabled"><a href="#">&laquo;</a></li>';
                }
                else{
                    echo '<li><a href="/home/1/'.$sort.'">&laquo;</a></li>';
                }
                if($page==1){
                    echo '<li class="disabled"><a href="#">&lsaquo;</a></li>';
                }
                else{
                    echo '<li><a href="/home/'.($page-1).'/'.$sort.'">&lsaquo;</a></li>';
                }
                for($i=min($page,abs($maxpage-4)); $i<=min(4+$page,$maxpage); $i++){
                    if($i==$page){
                        echo '<li class="active"><a href="/home/'.$i.'/'.$sort.'">'.$i.'</a></li>';
                    }
                    else{
                        echo '<li><a href="/home/'.$i.'/'.$sort.'">'.$i.'</a></li>';
                    }
                }


                if($page==$maxpage){
                    echo '<li class="disabled"><a href="#">&rsaquo;</a></li>';
                }
                else{
                    echo '<li><a href="/home/'.($page+1).'/'.$sort.'">&rsaquo;</a></li>';
                }
                if($page==$maxpage){
                    echo '<li class="disabled"><a href="#">&raquo;</a></li>';
                }
                else{
                    echo '<li><a href="/home/'.$maxpage.'/'.$sort.'">&raquo;</a></li>';
                }


                ?>


                <li><div class="btn-group">
                        <div class="btn-toolbar">
                            <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Check Out
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/home/1/viewed">Most Viewed</a></li>
                                <li><a href="/home/1/liked">Most Liked</a></li>
                                <li><a href="/home/1/new">New</a></li>

                                <!--<li><a href="#">Hot</a></li>-->
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>



    </div>

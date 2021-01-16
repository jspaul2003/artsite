@extends('main')
@push('head')
    <link href='/css/home.css' type='text/css' rel='stylesheet'>
@endpush

@section('data')

<h1 id="page_title">Home</h1>

<?php //phpinfo(); ?>

    <p></p>
    <br>
    <p></p>
    <br>



    <h2><a class="all" href="/home/1/viewed">
            Most Viewed
        </a>
    </h2>


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

foreach ($viewed as $fullfile) {
            $file=$fullfile->filename;
    if($file=="default"){
        $file="default.png";
        if ($file !== '.' && $file !== '..' && $file !== '.DS_Store') {
            $files[] = $file;

            echo '
                <div class="gallery default1">
                 <a href="art/'. $fullfile->id . '">
                    <img class="default" src="images/'. $file .'">
                    <div class="centered">Writing</div>
                </a>
                <h5><div class="titus">'
                .$fullfile->title.
                '</div></h5><div class="titus">'
                .$fullfile->user.
                '</div></a>
            </div>';
        }


    }
    else{
        if ($file !== '.' && $file !== '..' && $file !== '.DS_Store') {
            $files[] = $file;

            echo '
                <div class="gallery">
                 <a href="art/'. $fullfile->id . '">
                    <img src="images/'. $file .'">
                </a>
                <h5><div class="titus">'
                .$fullfile->title.
                '</div></h5><div class="titus">'
                .$fullfile->user.
                '</div></a>
            </div>';
        }
    }
}

//var_dump($files);

?>
</div>
<p></p>
<br>
<p></p>
<br>



    <h2><a class="all" href="/home/1/liked">Most Liked</a></h2>

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

        foreach ($liked as $fullfile) {
            $file=$fullfile->filename;
            if($file=="default"){
                $file="default.png";
                if ($file !== '.' && $file !== '..' && $file !== '.DS_Store') {
                    $files[] = $file;

                    echo '
                <div class="gallery default1">
                 <a href="art/'. $fullfile->id . '">
                    <img class="default" src="images/'. $file .'">
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
                 <a href="art/'. $fullfile->id . '">
                    <img src="images/'. $file .'">
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

<p></p>
<br>
<p></p>
<br>


    <h2><a class="all" href="/home/1/new">
            New
        </a>
    </h2>

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

        foreach ($new as $fullfile) {
            $file=$fullfile->filename;

            if($file=="default"){
                $file="default.png";
                if ($file !== '.' && $file !== '..' && $file !== '.DS_Store') {
                    $files[] = $file;

                    echo '
                <div class="gallery default1">
                 <a href="art/'. $fullfile->id . '">
                    <img class="default" src="images/'. $file .'">
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
                 <a href="art/'. $fullfile->id . '">
                    <img src="images/'. $file .'">
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


<p></p>
<br>
<p></p>
<br>






@endsection

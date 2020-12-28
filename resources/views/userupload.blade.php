@extends('main2')
@push('head')
    <meta name="_token" content="{{csrf_token()}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <link rel="stylesheet" href="/css/upload.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
@endpush


@section('extra_header_notification')
    <script> var retry=false;</script>
    @if(isset($error_data))

        @if($error_data[0]!="default")
            <div class="alert alert-dismissible alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>No Worries! </strong>
                <ul id='ule'>
                    Your image upload has been saved
                </ul>
            </div>
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Oh No! </strong>
                <ul id='ule'>
                    {{$error}}
                </ul>
            </div>

        @else
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Oh No! </strong>
            <ul id='ule'>
                {{$error}}
            </ul>
        </div>
        @endif


    @endif
@endsection





@section('data')
@if(Auth::check())
<div class="container">

    <h3 class="jumbotron">Upload Art Or Writing</h3>

    <form method="post" action="{{url('image/upload/store')}}" class='texts'>

        <div id='title'>
            @if(isset($error_data))
            {!! $error_data[2] !!}
            @endif
        </div>
        <script>
        var config = {
        "theme": "snow",
        "modules": {
        "toolbar": false
        },
        placeholder: "Title"
        };

        var quill = new Quill( "#title", config );
        </script>
    </form>
    <br>

    <form method="post" action="{{url('image/upload/store')}}" enctype="multipart/form-data"
          class="dropzone" id="dropzone"
          onsubmit="
            var titlee = document.querySelector('#title');
            var title = titlee.children[0].innerHTML;
            console.log(title);

            var desce = document.querySelector('#description');
            var desc = desce.children[0].innerHTML;
            console.log(desc);

            var tagse = document.querySelector('#tags');
            var tags = tagse.children[0].innerHTML;
            console.log(tags);

            document.getElementById('titlei').value=title;

            document.getElementById('descriptioni').value=desc;

            document.getElementById('tagsi').value=tags;

            return true;
        "


          >
        @if(isset($error_data))
            <input type="hidden" name='filename' id='filename' value={{$error_data[0]}}>
            <input type="hidden" name="title"  id='titlei' value={{$error_data[2]}}>
            <input type="hidden" name="description"  id='descriptioni' value={{$error_data[1]}}>
            <input type="hidden" name="tags" id='tagsi' value={{$error_data[3]}}>
        @else
            <input type="hidden" name='filename' id='filename' value="default">
            <input type="hidden" name="title"  id='titlei' value="NoName">
            <input type="hidden" name="description"  id='descriptioni' value="<p></p>">
            <input type="hidden" name="tags" id='tagsi' value="empty">
        @endif

        <div class="dz-message" data-dz-message><span id="dzmessage">Drag & Drop your Art here or <p id="extracom">browse</p></span></div>
        @csrf

        <script type="text/javascript">
            Dropzone.options.dropzone =
                {
                    autoProcessQueue: true,
                    maxFilesize: 12,
                    maxFiles: 1,
                    addRemoveLinks : true,
                    init: function() {
                        this.removeAllFiles();
                        myDropzone = this;


                        this.on("maxfilesexceeded", function(file){
                            this.removeAllFiles();
                            this.addFile(file);
                        });
                    },
                    renameFile: function(file) {
                        var user = {!! json_encode((array)auth()->id()) !!}[0];
                        console.log("drunk");
                        console.log(user);
                        var dt = new Date();
                        var time = dt.getTime();
                        document.getElementById('filename').value=(time+'_'+user+file.name).replace(/\s/g, '_');
                        return (time+'_'+user+file.name).replace(/\s/g, '_');
                    },
                    accept: function(file, done) {
                        console.log("uploaded");
                        done();
                    },

                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    addRemoveLinks: true,
                    timeout: 50000,
                    removedfile: function(file)
                    {
                        var name = file.upload.filename;
                        document.getElementById('filename').value='default';
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            type: 'POST',
                            url: '{{ url("image/delete") }}',
                            data: {filename: name},
                            success: function (data){
                                console.log("File has been successfully removed!!");
                            },
                            error: function(e) {
                                console.log(e);
                            }});
                        var fileRef;
                        return (fileRef = file.previewElement) != null ?
                            fileRef.parentNode.removeChild(file.previewElement) : void 0;
                    },


                    success: function(file, response)
                    {
                        console.log(response);
                    },
                    error: function(file, response)
                    {
                        return false;
                    }
                };
        </script>


    </form>



    <br>




    <form method="post" action="{{url('image/upload/store')}}" id='descid' class='texts'  >


        <div id="description">
            @if(isset($error_data))
                {!! $error_data[1]!!}
            @endif


        </div>
            <script>
                var quill = new Quill('#description', {
                    modules: {
                        toolbar: [
                            ['bold', 'italic'],
                            [{ list: 'ordered' }, { list: 'bullet' }]
                        ]
                    },
                    placeholder: 'Description or Writing',
                    theme: 'snow'
                });
            </script>
         <br>
    </form>

    <form method="post" action="{{url('image/upload/store')}}" id='tagid' class='texts' >
        <div id='tags'>
            @if(isset($error_data))
                {!! $error_data[3]!!}
            @endif
        </div>
        <script>
            var config = {
                "theme": "snow",
                "modules": {
                    "toolbar": false
                },
                placeholder: "Tags: Art Writing Tag1..."
            };

            var quill = new Quill( "#tags", config );
        </script>
        <br>
    </form>

    <input type="submit" value='Upload' id='btn' form='dropzone'>



    </div>
@endif



@endsection

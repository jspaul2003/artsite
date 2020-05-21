@extends('main')
@push('head')
    <meta name="_token" content="{{csrf_token()}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <link rel="stylesheet" href="/css/upload.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
@endpush

@section('data')
<div class="container">

    <h3 class="jumbotron">Upload Art Or Writing Here</h3>

    <form method="post" action="{{url('image/upload/store')}}" class='texts'>

        <div id='title'></div>
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
          onsubmit =
          "

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
        <input type="hidden" name='filename' id='filename' value="default">
        <input type="hidden" name="title"  id='titlei' value="NoName">
        <input type="hidden" name="description"  id='descriptioni' value="<p></p>">
        <input type="hidden" name="tags" id='tagsi' value="empty">


        <div class="dz-message" data-dz-message><span>Drop or upload your art here</span></div>
        @csrf

        <script type="text/javascript">
            Dropzone.options.dropzone =
                {
                    maxFilesize: 12,
                    renameFile: function(file) {
                        var dt = new Date();
                        var time = dt.getTime();
                        document.getElementById('filename').value=time+file.name;
                        return time+file.name;
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


        <div id="description"></div>
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
        <div id='tags'></div>
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
@endsection
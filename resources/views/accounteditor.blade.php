@extends('main')
@push('head')
    <meta name="_token" content="{{csrf_token()}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <link href='/css/accounteditor.css' type='text/css' rel='stylesheet'>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/paper/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
@endpush

@section('data')
    <h1>Edit Your Profile</h1>

    <br>
    <div id="bigdiv">
    <form method="post" action="{{url('account/edited/store')}}" class='texts'>
        <div id='name'></div>
        <script>
            var user = {!! auth()->user()!!};
            var config = {
                "theme": "snow",
                "modules": {
                    "toolbar": false
                },
                placeholder: "Name"
            };

            var quill = new Quill( "#name", config );
            quill.setText(user["name"]);
        </script>
        <br>
        <div id='disabled'></div>
        <script>
            var user = {!! auth()->user()!!};
            var config = {
                "theme": "snow",
                "modules": {
                    "toolbar": false
                },
                placeholder: "Username but you'll never see this hahaha"
            };

            var quill = new Quill( "#disabled", config );
            quill.setText(user["username"]);
            quill.enable(false);
        </script>
    </form>


    <div id="img-container">
    <form method="post" action="{{url('account/edited/store')}}" enctype="multipart/form-data"
              class="dropzone" id="dropzone"
              onsubmit =
              "

          var namee = document.querySelector('#name');
          var name = namee.children[0].innerHTML;
          name=name.slice(3,name.indexOf('</p>'));

          if(name=='<br>' || !name.replace(/\s/g, '')){
            name=user['name'];
          }

          var aboute = document.querySelector('#about');
          var about = aboute.children[0].innerHTML;
          var about2=about.slice(3,about.indexOf('</p>'));

          if(about2=='<br>' || !about2.replace(/\s/g, '')){
            about='';
          }

          var loce = document.querySelector('#location');
          var location = loce.children[0].innerHTML;
          location=location.slice(3,location.indexOf('</p>'));

          if(location=='<br>' || !location.replace(/\s/g, '')){
            location='';
          }

          console.log('hello');


          console.log(location);
          console.log(about);
          console.log(name);


          document.getElementById('namei').value=name;

          document.getElementById('abouti').value=about;

          document.getElementById('showmaili').value=document.getElementById('showmail').checked;

          document.getElementById('locationi').value=location;

          document.getElementById('showloci').value=document.getElementById('showloc').checked;


          console.log(document.getElementById('showloci').value);

          return true;


          "


        >
            <input type="hidden" name="name"  id='namei' value="{{Auth::user()["name"]}}">
            <input type="hidden" name='filename' id='filename' value="{{Auth::user()["profilefile"]}}">
            <input type="hidden" name="about"  id='abouti' value="{{Auth::user()["about"]}}">
            <input type="hidden" name="showmail"  id='showmaili' value="{{Auth::user()["showmail"]}}">
            <input type="hidden" name="location" id='locationi' value="{{Auth::user()["location"]}}">
            <input type="hidden" name="showloc" id='showloci' value="{{Auth::user()["showloc"]}}">


            <div class="dz-message" data-dz-message>
                <span>
                    <p class="notice">Drop or upload a profile picture</p>
                    <br>
                    @if(Auth::user()["profilefile"]!="default1")
                        <image class="profilepic" src='/profilepics/{{Auth::user()["profilefile"]}}'>
                    @else
                        <image class="profilepic" src='/img/default1.png'>
                    @endif
                </span>
            </div>
            @csrf

            <script type="text/javascript">
                Dropzone.options.dropzone =
                    {
                        maxFilesize: 12,
                        renameFile: function(file) {
                            var user = {!! json_encode((array)auth()->id()) !!}[0];
                            var dt = new Date();
                            var time = dt.getTime();
                            document.getElementById('filename').value=time+'_'+user+file.name;
                            return time+'_'+user+file.name;
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
                                url: '{{ url("account/delete") }}',
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
        </div>

        <br>

        <form method="post" action="{{url('account/edited/store')}}" id='descid' class='texts'  >
            <div id="about"></div>
            <script>
                var user = {!! auth()->user()!!};
                var quill = new Quill('#about', {
                    modules: {
                        "toolbar": false
                    },
                    placeholder: 'About',
                    theme: 'snow'
                });
                quill.root.innerHTML=user["about"];
            </script>
            <br>
        </form>


    <form method="post" action="{{url('account/edited/store')}}" class='texts'>
        <div id='email'></div>
        <script>
            var user = {!! auth()->user()!!};
            var config = {
                "theme": "snow",
                "modules": {
                    "toolbar": false
                },
                placeholder: "Email"
            };

            var quill = new Quill( "#email", config );
            quill.setText(user["email"]);
            quill.enable(false);
        </script>
    </form>

    <br>

    <form method="post" action="{{url('account/edited/store')}}" class='texts'>
        <input type="checkbox" class="custom-control-input" id="showmail">
        <label class="custom-control-label" for="customSwitches">    Show Email?  </label>
        <script>
            var user = {!! auth()->user()!!};
            if(user["showmail"]==1){
                document.getElementById("showmail").checked = true;
            }
            else{
                document.getElementById("showmail").checked = false;
            }
        </script>
    </form>

    <br>

    <form method="post" action="{{url('account/edited/store')}}" class='texts'>
        <div id='location'></div>
        <script>
            var user = {!! auth()->user()!!};
            var config = {
                "theme": "snow",
                "modules": {
                    "toolbar": false
                },
                placeholder: "Location"
            };

            var quill = new Quill( "#location", config );
            quill.setText(user["location"]);
        </script>
    </form>

    <br>

    <form method="post" action="{{url('account/edited/store')}}" class='texts'>
        <input type="checkbox" class="custom-control-input" id="showloc">
        <label class="custom-control-label" for="customSwitches">    Show Location?  </label>
        <script>
            var user = {!! auth()->user()!!};
            if(user["showloc"]==1){
                document.getElementById("showloc").checked = true;
            }
            else{
                document.getElementById("showloc").checked = false;
            }
        </script>
    </form>

    <br>

    <button id="cancel">Cancel</button>

    <input class="bar" type="submit" value='Save' id='btn' form='dropzone'>

    <script>
    but=document.getElementById("cancel");
    but.onclick = function(){
        location.replace("/account")
    };
    </script>
    </div>





@endsection

{{--Standard Template code --}}
        <!doctype html>
<html lang='en'>
<head>
    <title>Unlocked Art</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootswatch.css">
    <link href='/css/base.css' type='text/css' rel='stylesheet'>
    @stack('head')
</head>
<body>
<header>
    <div>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Unlocked Art</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav">
                    <li id="home"><a href="/">Home <span class="sr-only">(current)</span></a></li>
                </ul>

                <form class="navbar-form navbar-left" role="search" method='GET' action='/search'>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" name= "Search" id="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>

                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
                        <li><a href="/image/upload">Upload</a></li>



                        <li class="dropdown">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My Account <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/account">Profile</a></li>

                            <li><a href="{{ url('/logout') }}">Logout</a></li>

                            <li class="divider"></li>
                            <li><a href="#">Need Help? <br> Email: help@unlockedart.com</a></li>
                            <li><a href="#">Need Help? <br> Email: help@unlockedart.com</a></li>

</ul>

                        </li>

                    @else
                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My Account <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/register">Sign Up</a></li>

                                <li><a href="/login">Login</a></li>

                                <li class="divider"></li>
                                <li><a href="#">Need Help? Email help@unlockedart.com</a></li>

                            </ul>

                        </li>

                    @endif

                </ul>
            </div>

        </div>
    </nav>
    </div>
    @yield('extra_header_notification')
</header>
<div id="my_content">
@yield('data')
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</body>
</html>

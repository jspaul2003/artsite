{{--Standard Template code --}}
        <!doctype html>
<html lang='en'>
<head>
    <title>Covart</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/fix.css">
    <link href='/css/base.css' type='text/css' rel='stylesheet'>
    @stack('head')
</head>
<body>
<header>
    <ul id="ulh">
        <li><h2 id='hh'>Covart</h2></li>
        @if(Auth::check())
            <li>
                <form method='POST' id='logout' action='/logout'>
                    {{ csrf_field() }}
                    <a id='lg' href='#' onClick='document.getElementById("logout").submit();'>Logout</a>
                </form>
            </li>
            <li><a href="/account" class="linkh">My Account</a></li>
            <li><a href='/image/upload' class='linkh'> Upload</a></li>
        @else
           <li><a href="/login" class="linkh">Login</a></li>
           <li><a href="/register" class="linkh">Sign Up</a></li>
        @endif
        </ul>
</header>
<section id='gap'></section>
@yield('data')
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</body>
</html>
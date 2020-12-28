@extends('main')
@push('head')
    <link href='/css/sign.css' type='text/css' rel='stylesheet'>
@endpush

@section('data')
    <section id='formarea'>
        <h2>Login</h2>
        <br>
        <form method="post" action='{{route('login')}}'>
            {{ csrf_field() }}
            <p>
                <input id='email' type='email' name='email' value='{{ old('email') }}' placeholder='Email' required>
            </p>
            <br>
            <p>
                <input type="password" name="password" id="password" placeholder='Password' required>
            </p>
            <br>
            <input type="submit" value='Login' id='btn'>
            <br>
            <br>

            <a id='extra2' href='/password/reset'>Forgot Password?</a>
            <br>
            <br>

            <a id='extra2' href='/register'>Create Account</a>
        </form>
    </section>
@endsection

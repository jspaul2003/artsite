@extends('main')
@push('head')
    <link href='/css/sign.css' type='text/css' rel='stylesheet'>
@endpush

@section('data')
    <section id='formarea'>
        <h2>Login</h2>
        <p>Login here!</p>
        <br>
        <form method="post" action='{{route('login')}}'>
            {{ csrf_field() }}
            <p>Email
                <input id='email' type='email' name='email' value='{{ old('email') }}' placeholder='Password' required>
            </p>
            <br>
            <p>Password
                <input type="password" name="password" id="password" placeholder='Password' required>
            </p>
            <br>
            <input type="submit" value='Login' id='btn'>
            <br>
            <br>
            <br>
            <a id='extra2' href='/register'>Create Account</a>
        </form>
    </section>
@endsection

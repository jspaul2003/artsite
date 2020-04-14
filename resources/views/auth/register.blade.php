@extends('main')
@push('head')
    <link href='/css/sign.css' type='text/css' rel='stylesheet'>
@endpush

@section('data')
    <section id='formarea'>
        <h2>Create your new account</h2>
        <p>Joining is easy!</p>
        <form method="post" action='{{ route('register') }}'>
            {{ csrf_field() }}
            <br>
            <p>Name
                <input id='name'
                type='text'
                name='name'
                placeholder='Name'
                value='{{ old('name') }}' required autofocus>
                <br>
               <p class='extra'>This is required</p>
            </p>
            <br>
            <p>Password
                <input type="password"
                       name="password"
                       id="password"
                       placeholder='Password'
                       minlength='6'
                       required>
                <br>
            <p class='extra'>Use at least 6 characters</p>
            </p>
            <br>
            <p>Confirm Password
                <input id='password-confirm'
                       type='password'
                       name='password_confirmation'
                       placeholder='Confirm Password'
                       minlength='6'
                       required>
                <br>
            <p class='extra'>This is required</p>
            </p>
            <br>
            <p>Your Email
                <input
                id='email'
                type='email'
                name='email'
                placeholder='Email'
                value='{{ old('email') }}'
                required>
                <p class='extra'>This is what you will use to login with</p>
            </p>
            <br>
            <input type="submit" value='Join' id='btn'>
            <br>
            <br>
            <br>
        </form>
    </section>
    @if(count($errors) > 0)
        <section id='results'>
            <h2 class='note'>Uh Oh! </h2>
            <img src='/img/cross.png' id='cr' alt='cross'>
            <ul id='ule'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </section>
    @endif
@endsection
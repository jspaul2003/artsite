@extends('main')
@push('head')
    <link href='/css/sign.css' type='text/css' rel='stylesheet'>
@endpush


@section('extra_header_notification')
    @if(count($errors) > 0)
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Oh No! </strong>
            <ul id='ule'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection


@section('data')
    <section id='formarea'>
        <h2>Create your new account</h2>
        <p>Joining is easy!</p>
        <form method="post" action='{{ route('register') }}'>
            {{ csrf_field() }}
            <br>
            <p>
                <input id='name'
                type='text'
                name='name'
                placeholder='Name'
                value='{{ old('name') }}' required autofocus>
                <br>
               <p class='extra'>This is required</p>
            </p>
            <br>
            <p>
                <input
                        id='username'
                        type='text'
                        name='username'
                        placeholder='Username'
                        value='{{ old('username') }}'
                        required>
            </p>
            <p class='extra'>This is what others will see</p>
            <br>
            <p>
                <input
                        id='email'
                        type='email'
                        name='email'
                        placeholder='Email'
                        value='{{ old('email') }}'
                        required>
            </p>
            <p class='extra'>This is what you will use to login with</p>
            <br>
            <p>
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
            <p>
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
            <input type="hidden"
                   name="prof"
                   value='default1'
            >
            <br>
            <input type="submit" value='Join' id='btn'>
            <br>
            <br>
            <br>
            <a id='extra2' href='/login'>Login instead</a>
            <br>
            <br>
        </form>
    </section>
@endsection

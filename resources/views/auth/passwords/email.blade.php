@extends('main')
@push('head')
    <link href='/css/sign.css' type='text/css' rel='stylesheet'>
@endpush

@section('data')
    <section id='formarea'>
        <h1>Reset</h1>
        <p>Reset Your password here; An email will be sent to you!</p>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form method="post" action='{{ route('password.email') }}'>
            {{ csrf_field() }}
            <br>
            <p>Email
                <input id='email' type='email' name='email' value='{{ old('email') }}' required>
               (This is required)
            </p>
            <br>
            <input type="submit" value='Reset' id='btn'>
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

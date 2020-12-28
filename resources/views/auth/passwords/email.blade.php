@extends('main')
@push('head')
    <link href='/css/sign.css' type='text/css' rel='stylesheet'>
@endpush

@section('data')
    <section id='formarea'>
        <h1>Reset Password</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form method="post" action='{{ route('password.email') }}'>
            {{ csrf_field() }}
            <br>
            <p>
                <input id='email' type='email' name='email' value='{{ old('email') }}' placeholder="Email" required>
               <p class='extra'>This is required</p>
            </p>
            <br>
            <input type="submit" value='Reset' id='btn'>
            <br>
            <br>
            <br>
        </form>
    </section>
    @if(count($errors) > 0)
        @section('extra_header_notification')
                                    <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Oh No! </strong>
            <ul id='ule'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
                                    </div>
                                        @endsection
    @endif
@endsection

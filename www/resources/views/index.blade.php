@extends('layouts.login_base')


@section('content')
<div class="body"></div>

<div class="grad"></div>
<div class="header">
    <div>SPC<span> Faculty<br>Locator</span></div>
</div>
<br>
<div class="login">

    @if( Session::has( 'info' ))
        <div class="alert-danger">
             {{ Session::get( 'info' ) }} <!-- here to 'withWarning()' -->
        </div>

    @elseif($errors)

        @foreach($errors->all() as $error)
            <div class="alert-danger">
                {{ $error }}
            </div>
        @endforeach

    @endif

    <form class="" method="post" action="{{ route('auth.login') }}">
        {{ csrf_field() }}
        <input type="text" placeholder="username" name="username"><br>
        <input type="password" placeholder="password" name="password"><br>
        <button type="submit" name="button">Login</button>
    </form>
    <!-- <a href="{{ route('index.create') }}"><button type="submit" name="button">I am a student!</button> </a> -->
    </div>
@endsection

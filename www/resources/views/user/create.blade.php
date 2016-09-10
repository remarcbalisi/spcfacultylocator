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

    @elseif( Session::has( 'success' ))
        <div class="alert-success">
             {{ Session::get( 'success' ) }} <!-- here to 'withWarning()' -->
        </div>

    @elseif($errors)

        @foreach($errors->all() as $error)
            <div class="alert-danger">
                {{ $error }}
            </div>
        @endforeach

    @endif

    <form class="" method="post" action="{{ route('index.store') }}">
        {{ csrf_field() }}
        <input type="text" placeholder="name" name="name"><br>
        <input type="text" placeholder="username" name="username"><br>
        <input type="text" placeholder="email" name="email"><br>
        <input type="password" placeholder="password" name="password"><br>
        <input type="hidden" name="type" value="student">
        <select name="department">
            @foreach( $departments as $department)
                <option value="{{$department->id}}">{{$department->name}}</option>
            @endforeach
        </select><br>
        <button type="submit" name="button">Send Registration Request</button>
    </form>
    <a href="{{url('/')}}"><button type="submit" name="button">Back</button></a>
    </div>
@endsection

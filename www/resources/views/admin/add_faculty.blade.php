@extends('layouts.admin_home_base')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>FORMS <span class="glyphicon glyphicon-chevron-right"></span> ADD FACULTY</h2>
        </div>

        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            FACULTY REGISTRATION
                            <small>Add new user</small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">

                        @if( Session::has( 'info' ))
                            <div class="alert alert-success alert-dismissible">
                                <strong>Well done!</strong> {{ Session::get( 'info' ) }}
                            </div>

                        @elseif($errors)

                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    <strong>Oh snap!</strong> {{ $error }}
                                </div>
                            @endforeach

                        @endif

                        <form class="" action="{{ route('admin::faculty.store', ['username'=>Auth::user()->username]) }}" method="post">
                            {{ csrf_field() }}
                            <input name="type" type="hidden" value="faculty">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="id_number" type="text" class="form-control">
                                            <label class="form-label">ID number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="name" type="text" class="form-control">
                                            <label class="form-label">Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="email" type="text" class="form-control">
                                            <label class="form-label">Email</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <select name="department" class="form-control show-tick">
                                        <option value="">-- Please select department --</option>
                                        @foreach( $departments as $department )
                                        <option value="{{$department->id}}">{{ $department->name }} ({{$department->college}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="device_id" type="text" class="form-control">
                                            <label class="form-label">Device id</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit" name="button">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Input -->

    </div>
</section>
@endsection

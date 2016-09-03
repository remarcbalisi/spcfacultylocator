@extends('layouts.admin_home_base')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">PENDING REQUESTS</div>
                        <div class="number count-to" data-from="0" data-to="{{$pending_requests->count()}}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">help</i>
                    </div>
                    <div class="content">
                        <div class="text">NEW TICKETS</div>
                        <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">forum</i>
                    </div>
                    <div class="content">
                        <div class="text">NEW COMMENTS</div>
                        <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div> -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">USER COUNT</div>
                        <div class="number count-to" data-from="0" data-to="{{$user_count}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            USER LISTS
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
                        @endif

                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>College</th>
                                    <th>Department</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>College</th>
                                    <th>Department</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->user_type }}</td>
                                    <td>{{ $user->department->name }}</td>
                                    <td>{{ $user->department->college }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>

                                    <td>
                                        @if($user->user_type == 'faculty')
                                        <a href="{{ route('admin::faculty.edit', ['username'=>Auth::user()->username, 'id'=>$user->id]) }}"><button class="btn btn-warning" type="button" name="button">Edit</button></a>
                                        @elseif($user->user_type == 'student' || $user->user_type == 'admin')
                                        <a href="{{ route('admin::user.edit', ['username'=>Auth::user()->username, 'id'=>$user->id]) }}"><button class="btn btn-warning" type="button" name="button">Edit</button></a>
                                        @endif
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{$user->username}}">
                                            Delete
                                        </button>

                                    </td>

                                </tr>

                                <!-- For Material Design Colors -->
                                <div id="{{$user->username}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content modal-col-red">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Are you sure you want to delete?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h2>{{$user->name}}</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('admin::user.destroy', ['username'=>Auth::user()->username, 'id'=>$user->id]) }}" method="post">
                                                {{ csrf_field() }}
                                                {!! method_field('delete') !!}
                                                <button class="btn btn-danger" type="submit" name="button">Yes</button>
                                            </form>
                                            <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                                        </div>
                                    </div>

                                    </div>
                                </div>
                                <!-- END For Material Design Colors -->

                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->

    </div>
</section>

@endsection

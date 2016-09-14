@extends('layouts.admin_home_base')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>PENDING REQUESTS</h2>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            PENDING REQUESTS LISTS
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
                        @elseif( Session::has( 'success' ))
                            <div class="alert alert-success alert-dismissible">
                                <strong>Well done!</strong> {{ Session::get( 'success' ) }}
                            </div>
                        @elseif( Session::has( 'danger' ))
                            <div class="alert alert-danger alert-dismissible">
                                <strong>Failed!</strong> {{ Session::get( 'danger' ) }}
                            </div>
                        @endif

                        <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($reqs as $req)
                                <tr>
                                    <td>{{ $req->title }}</td>

                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{$req->id}}_preview">
                                            Preview
                                        </button>
                                        <form action="{{ route('admin::pending_requests.store', ['username'=>Auth::user()->username, 'id'=>$req->id]) }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="action" value="accept">
                                            <a href="{{ route('admin::faculty.edit', ['username'=>Auth::user()->username, 'id'=>$req->id]) }}">
                                                <button class="btn btn-success" type="submit" name="button">Accept</button>
                                            </a>
                                        </form>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{$req->id}}">
                                            Delete
                                        </button>

                                    </td>

                                </tr>

                                <!-- For Material Design Colors DELETE -->
                                <div id="{{$req->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content modal-col-red">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Are you sure you want to delete?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h4>{{$req->title}}</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('admin::pending_requests.store', ['username'=>Auth::user()->username, 'id'=>$req->id]) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="action" value="delete">
                                                <button class="btn btn-danger" type="submit" name="button">Yes</button>
                                            </form>
                                            <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                                        </div>
                                    </div>

                                    </div>
                                </div>
                                <!-- END For Material Design Colors DELETE -->

                                <!-- For Material Design Colors PREVIEW -->
                                <div id="{{$req->id}}_preview" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content modal-col-blue">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">{{$req->user->name}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                Username: {{$req->user->name}}
                                            </p>
                                            <p>
                                                College: {{$req->user->department->college}}
                                            </p>
                                            <p>
                                                Department: {{$req->user->department->name}}
                                            </p>
                                            <p>
                                                Email: {{$req->user->email}}
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">close</button>
                                        </div>
                                    </div>

                                    </div>
                                </div>
                                <!-- END For Material Design Colors PREVIEW -->

                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->

        <div class="row clearfix">
            <!-- Task Info -->
            <div style="display:none" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="header">
                        <h2>TASK INFOS</h2>
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
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Task</th>
                                        <th>Status</th>
                                        <th>Manager</th>
                                        <th>Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Task A</td>
                                        <td><span class="label bg-green">Doing</span></td>
                                        <td>John Doe</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Task B</td>
                                        <td><span class="label bg-blue">To Do</span></td>
                                        <td>John Doe</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Task C</td>
                                        <td><span class="label bg-light-blue">On Hold</span></td>
                                        <td>John Doe</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-light-blue" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Task D</td>
                                        <td><span class="label bg-orange">Wait Approvel</span></td>
                                        <td>John Doe</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Task E</td>
                                        <td>
                                            <span class="label bg-red">Suspended</span>
                                        </td>
                                        <td>John Doe</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
            <!-- Browser Usage -->
            <div style="display:none" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="header">
                        <h2>BROWSER USAGE</h2>
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
                        <div id="donut_chart" class="dashboard-donut-chart"></div>
                    </div>
                </div>
            </div>
            <!-- #END# Browser Usage -->
        </div>
    </div>
</section>

@endsection

@extends('layouts.adminHeader')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="card-title">Users</h4>

                            <div class="text-center">
                                <input data-plugin="knob" data-width="120" data-height="120" data-linecap=round
                                    data-fgColor="#31cb72" value="{{ count($totalUsers) }}" data-skin="tron"
                                    data-angleOffset="180" data-readOnly=true data-thickness=".1" />

                                <div class="clearfix"></div>
                                <a href="#" class="btn btn-sm btn-light mt-2">View All Data</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="card-title">Notifications</h4>

                            <div class="text-center">
                                <input data-plugin="knob" data-width="120" data-height="120" data-linecap=round
                                    data-fgColor="#ff5b5b" value="{{ count($totalNotifications) }}" data-skin="tron"
                                    data-angleOffset="180" data-readOnly=true data-thickness=".1" />

                                <div class="clearfix"></div>
                                <a href="#" class="btn btn-sm btn-light mt-2">View All Data</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Basic Data Table</h4>

                            <table id="basic-datatable" class="table dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Start Date</th>
                                        <th>Action</th>
                                        <th>Total Notifications</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($totalUsers as $user)
                                        <tr>
                                            <td>{{ $user['name'] }}</td>
                                            <td>{{ $user['email'] }}</td>
                                            <td>{{ date('d M, Y', strtotime($user['created_at'])) }}</td>
                                            <td><a href="{{ url('getUserProfile/') . '/' . $user['id'] }}"><button
                                                        class="btn btn-primary waves-effect waves-light">Check</button></a>
                                            </td>
                                            <td>: {{ count($user['user_notifications']) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container-fluid -->
    </div>
@endsection

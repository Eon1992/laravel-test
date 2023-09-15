@extends('layouts.adminHeader')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Notifications</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Notifications</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="button-examples text-right">
                                <a href="{{ route('createNotification') }}">
                                    <button class="btn btn-primary waves-effect waves-light">Add +</button>
                                </a>
                            </div>
                            <div class="mt-4 mb-0"></div>
                            <table id="complex-header-datatable" class="table dt-responsive nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Text</th>
                                        <th>Create Date</th>
                                        <th>Expiration Date</th>
                                        <th>Expiration Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($totalNotifications as $notification)
                                        <tr>
                                            <th>{{ $notification['title'] }}</th>
                                            @if ($notification['type'] == '1')
                                                <th>Marketing</th>
                                            @elseif($notification['type'] == '2')
                                                <th>Invoice</th>
                                            @else
                                                <th>Systems</th>
                                            @endif
                                            <th>{{ $notification['shortText'] }}</th>
                                            <th>{{ date('d M, Y', strtotime($notification['created_at'])) }}</th>
                                            <th>{{ date('d M, Y', strtotime($notification['expiration'])) }}</th>
                                            <th>{{ date('d M, Y', strtotime($notification['expiration'])) }}</th>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Text</th>
                                        <th>Create Date</th>
                                        <th>Expiration Date</th>
                                        <th>Expiration Date</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container-fluid -->
    </div>
@endsection

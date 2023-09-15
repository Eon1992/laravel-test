@extends('layouts.userForm')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">User Profile</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Profile</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">User Profile </h4>

                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    A simple success alert—check it out!
                                </div>
                            @endif
                            <form class="needs-validation" novalidate action="{{ route('saveNotification') }}"
                                method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="validationCustom01">Title</label>
                                    <input type="text" class="form-control" id="validationCustom01" placeholder="Title"
                                        value="" required name="title">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please Enter a title.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="validationCustom02">Select Type</label>
                                    <select class="form-control" id="validationCustom02" required name="type">
                                        <option value=""> Select </option>
                                        <option value="1">Market</option>
                                        <option value="2">Invoice</option>
                                        <option value="3">System</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please Select Type.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="validationCustom03">Short Text</label>
                                    <input type="text" class="form-control" id="validationCustom03"
                                        placeholder="Short Text" value="" required name="shortText">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please Enter a short text.
                                    </div>
                                </div>

                                <button class="btn btn-primary waves-effect waves-light" type="submit">Submit form</button>

                            </form>
                        </div>
                        <!-- end card-body-->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->

            </div>
            <!-- end row-->
        </div> <!-- container-fluid -->
    </div>
@endsection

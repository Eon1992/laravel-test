@extends('layouts.adminForm')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Add Notification</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Notifications</a></li>
                                <li class="breadcrumb-item active">Add</a></li>
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
                            <h4 class="card-title">Form Controls </h4>
                            <p class="card-subtitle mb-4">Textual form controls—like <code>input</code>s,<code>
                                    selects</code>, and<code> textare</code>s—are styled with the .form-control class.
                                Included are styles for general appearance, focus state, sizing, and more. </p>

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

                                <div class="form-group">
                                    <label for="validationCustom04">Expiration Date</label>
                                    <input type="text" class="form-control" id="validationCustom04"
                                        data-provide="datepicker" value="" required name="expiration">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please Select Expiration Date.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="validationCustom05">Select Users</label>
                                    <select class="form-control select2-multiple" id="validationCustom05"
                                        data-toggle="select2" required name="users[]" multiple="multiple"
                                        data-placeholder="Choose ...">
                                        <option value=""> Select </option>
                                        @foreach ($totalUsers as $user)
                                            <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please Select alteast one user.
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

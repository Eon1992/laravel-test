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
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form class="needs-validation" novalidate action="{{ route('updateUserProfile') }}"
                                method="POST">
                                @csrf

                                <input type="hidden" id="otpGenerated" class="form-control" value="">

                                <input type="hidden" class="form-control" value="{{ $user['id'] }}" name="id"
                                    id="userId">

                                <input type="hidden" class="form-control" value="{{ $user['otpVerified'] }}"
                                    id="otpVerified">

                                <div class="form-group">
                                    <label for="validationCustom01">Name</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Full Name" value="{{ $user['name'] }}" required name="name">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please Enter Full Name.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="validationCustom05">Notification Switch</label>
                                    <br>
                                    <input type="checkbox" {{ $user['notificationSwitch'] == '1' ? 'checked' : '' }}
                                        data-toggle="switchery" data-color="#2e7ce4" name="notificationSwitch" />
                                </div>

                                <div class="form-group">
                                    <label for="validationCustom02">Email</label>
                                    <input type="text" class="form-control" id="validationCustom02" placeholder="Email"
                                        value="{{ $user['email'] }}" required name="email">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please Enter Email.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="validationCustom03">Phone</label>
                                    <input type="text" class="form-control phone" id="validationCustom03"
                                        placeholder="Phone" maxlength="10" minlength="10" value="{{ $user['phone'] }}"
                                        required name="phone">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please Enter a Phone Number.
                                    </div>
                                </div>

                                <div class="form-group" style="display: none" id="otp">
                                    <input type="text" class="form-control" placeholder="OTP" value=""
                                        id="otpVal">
                                </div>

                                <div class="form-group">

                                    <button class="btn btn-primary waves-effect waves-light" id="otpBtn"
                                        type="button">Validate OTP</button>

                                    <button class="btn btn-primary waves-effect waves-light" style="display: none"
                                        id="confirmOtpBtn" type="button">Confirm OTP</button>

                                    <button class="btn btn-primary waves-effect waves-light" id="submitButton"
                                        style="display: none" type="submit">Submit</button>

                                </div>



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

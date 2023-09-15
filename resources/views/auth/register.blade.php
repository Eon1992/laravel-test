@extends('layouts.header')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center min-vh-100">
                    <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                        <div class="row">
                            <div class="col-lg-5 d-none d-lg-block bg-register rounded-left"></div>
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center mb-5">
                                        <a href="index.html" class="text-dark font-size-22 font-family-secondary">
                                            <i class="mdi mdi-album"></i> <b>Laravel Test</b>
                                        </a>
                                    </div>
                                    <h1 class="h5 mb-1">Create an Account!</h1>
                                    <p class="text-muted mb-4">Don't have an account? Create your own account, it takes
                                        less than a minute</p>
                                    <form class="user" id="sign_up" action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" id="name"
                                                    placeholder="Full Name" name="name">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="email" class="form-control form-control-user"
                                                    id="exampleInputEmail" placeholder="Email Address" name="email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user"
                                                    id="exampleInputPassword" placeholder="Password" name="password">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user"
                                                    id="exampleRepeatPassword" placeholder="Confirm Password"
                                                    name="confirm_password">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success btn-block waves-effect waves-light">
                                            Register Account
                                        </button>

                                    </form>

                                    <div class="row mt-4">
                                        <div class="col-12 text-center">
                                            <p class="text-muted mb-0">Already have account? <a href="{{ route('login') }}"
                                                    class="text-muted font-weight-medium ml-1"><b>Sign In</b></a></p>
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div> <!-- end .padding-5 -->
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div> <!-- end .w-100 -->
                </div> <!-- end .d-flex -->
            </div> <!-- end col-->
        </div> <!-- end row -->
    </div>
    <!-- end container -->
@endsection

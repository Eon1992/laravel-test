@extends('layouts.header')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center min-vh-100">
                    <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                        <div class="row">
                            <div class="col-lg-5 d-none d-lg-block bg-login rounded-left"></div>
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center mb-5">
                                        <a href="index.html" class="text-dark font-size-22 font-family-secondary">
                                            <i class="mdi mdi-album"></i> <b>Laravel Test</b>
                                        </a>
                                    </div>
                                    <h1 class="h5 mb-1">Welcome Back!</h1>
                                    <p class="text-muted mb-4">Enter your email address and password to access admin panel.
                                    </p>
                                    @if (session()->has('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session()->get('error') }}
                                        </div>
                                    @endif
                                    <form class="user" id="sign_in" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" placeholder="Email Address" name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password">
                                        </div>

                                        <button type="submit" class="btn btn-success btn-block waves-effect waves-light">
                                            Log In
                                        </button>


                                    </form>

                                    <div class="row mt-4">
                                        <div class="col-12 text-center">
                                            <p class="text-muted mb-2"><a href="pages-recoverpw.html"
                                                    class="text-muted font-weight-medium ml-1">Forgot your password?</a></p>
                                            <p class="text-muted mb-0">Don't have an account? <a
                                                    href="{{ route('register') }}"
                                                    class="text-muted font-weight-medium ml-1"><b>Sign Up</b></a></p>
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
@endsection

@extends('layouts.auth')

@section('title','Đăng nhập')

@section('content')
    <div class="card">
        <div class="row row-sm">
            <div class="col-lg-6 col-xl-5 d-none d-lg-block text-center bg-primary details">
                <div class="mt-5 pt-4 p-2 pos-absolute">
                    <img src="../../assets/img/brand/logo-light.png" class="header-brand-img mb-4" alt="logo">
                    <div class="clearfix"></div>
                    <h5 class="mt-4 text-white">Create Your Account</h5>
                    <span class="tx-white-6 tx-13 mb-5 mt-xl-0">Signup to create, discover and connect with the global community</span>
                </div>
            </div>
            <div class="col-lg-6 col-xl-7 col-xs-12 col-sm-12 login_form ">
                <div class="container-fluid">
                    <div class="row row-sm">
                        <div class="card-body mt-2 mb-2">
                            <img src="../../assets/img/brand/logo.png" class=" d-lg-none header-brand-img text-left float-left mb-4" alt="logo">
                            <div class="clearfix"></div>
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <h5 class="text-left mb-2">Signin to Your Account</h5>
                                <p class="mb-4 text-muted tx-13 ml-0 text-left">Signin to create, discover and connect with the global community</p>
                                <div class="form-group text-left">
                                    <label>Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" name="email" type="text">
                                    @error('email')
                                    {!! admin_validation($message) !!}
                                    @enderror
                                </div>
                                <div class="form-group text-left">
                                    <label>Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" name="password" type="password">
                                    @error('password')
                                    {!! admin_validation($message) !!}
                                    @enderror
                                </div>
                                <button class="btn ripple btn-main-primary btn-block" type="submit">Sign In</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- /.login-box -->
@endsection

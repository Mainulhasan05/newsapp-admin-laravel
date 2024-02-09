@extends('layouts.main_master')
@section('title', "Login")
@section('main_content')

<div class="container-fluid bg-primary">
    <div class="row d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="fw-bold text-secondary text-dark fw-bold">
                        Login
                    </h2>
                </div>
                <div class="card-body p-5">
                    <div class="text-center">
                        <img src="{{ asset('img/logo.png') }}" alt="logo" class="img-fluid" width="100">
                    </div>
                    <div class="text-center mb-3">
                        <h4 class="fw-bold text-secondary">Welcome Back</h4>
                    </div>
                    <div class="text-center mb-3">
                        <p class="text-secondary">Login to your account to continue</p>
                    </div>
                    {{-- <div class="text-center mb-3">
                        <a href="{{ route('login') }}" class="btn btn-danger rounded-0">
                            <i class="fab fa-google"></i> Login with Google
                        </a>
                    </div> --}}
                    {{-- show errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action={{ route('login') }} method="post" id="login_form">
                        @csrf
                        <div class="mb-3">
                            <input class="form-control rounded-0" placeholder="E-mail" type="email" name="email" id="email">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <input class="form-control rounded-0" placeholder="Password" type="password" name="password" id="password">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <a href="/forgot" class="text-decoration-none">Forgot Password?</a>
                        </div>

                        <div class="mb-3 d-grid">
                            <input type="submit" class="btn btn-info btn-block rounded-0" id="login_btn" value="Login">
                        </div>
                        
                        <div class="text-center text-secondary">
                            <div>
                                Don't have an account? <a href="" class="text-decoration-none">Register Here</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection

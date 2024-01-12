@extends('layouts.main_master')
@section('title', "Login")
@section('main_content')

<div class="container-fluid bg-dark">
    <div class="row d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="fw-bold text-secondary">
                        Login
                    </h2>
                </div>
                <div class="card-body p-5">
                    <form action="#" method="post" id="login_form">
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
                            <a href="" class="text-decoration-none">Forgot Password?</a>
                        </div>

                        <div class="mb-3 d-grid">
                            <input type="submit" class="btn btn-dark btn-block rounded-0" id="login_btn" value="Login">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection

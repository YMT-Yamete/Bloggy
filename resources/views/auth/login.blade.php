@extends('layout.layout')

@section('backgroundCss')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/background.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <form action="{{ url('/login') }}" method="POST">
                @csrf
                @if (session()->has('msg'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('msg') }}
                    </div>
                @endif
                <div class="card shadow" style="width: 30rem;">
                    <div class="card-body">
                        <h5 class="card-title text-center"><b>Login</b></h5>
                        <hr>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Email" name="email">
                            @error('email')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                placeholder="Password" name="password">
                            @error('password')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-success">Login</button>
                            <a href="{{ url('/register') }}">I don't have an account</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

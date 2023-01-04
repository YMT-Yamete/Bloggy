@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <form action="{{ url('/register') }}" method="POST">
                @csrf
                <div class="card shadow" style="width: 30rem;">
                    <div class="card-body">
                        <h5 class="card-title text-center"><b>Register</b></h5>
                        <hr>
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Name" name="name">
                            @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
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
                            <label for="phone">Phone</label>
                            <input type="phone" class="form-control @error('phone') is-invalid @enderror"
                                placeholder="Phone" name="phone">
                            @error('phone')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address">Address</label>
                            <textarea rows="4" class="form-control @error('title') is-invalid @enderror" name="address">{{ old('address') }}</textarea>
                            @error('address')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-success">Register</button>
                            <a href="{{ url('/login') }}">Already have an account?</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

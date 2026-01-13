@extends('layouts.app')

@section('main-col','col-md-6 offset-md-3')

@section('content')
<div class="card p-4 shadow-sm">
    <div class="text-center mb-3">
        <img src="{{ asset('logo.png') }}" alt="Logo" class="logo" width="80">
    </div>
    <h3 class="text-center mb-4" style="color: #d63384;">Login</h3>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" required autofocus>
            </div>
            @error('email')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       required>
            </div>
            @error('password')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="remember">
            <label class="form-check-label">Remember Me</label>
        </div>

        <div class="d-grid mb-2">
            <button class="btn btn-primary">Login</button>
        </div>

        <div class="text-center">
            <a href="{{ route('register') }}" class="text-decoration-none">Don't have an account? Register</a>
        </div>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('main-col','col-md-6 offset-md-3')

@section('content')
<div class="card p-4 shadow-sm">
    <div class="text-center mb-3">
        <img src="{{ asset('logo.png') }}" alt="Logo" class="logo" width="80">
    </div>
    <h3 class="text-center mb-4" style="color: #d63384;">Register</h3>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" required autofocus>
            </div>
            @error('name')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" required>
            </div>
            @error('email')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                <option value="">-- Select Role --</option>
                <option value="student">Student</option>
                <option value="counselor">Counselor</option>
            </select>
            @error('role')
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

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
        </div>

        <div class="d-grid mb-2">
            <button class="btn btn-primary">Register</button>
        </div>

        <div class="text-center">
            <a href="{{ route('login') }}" class="text-decoration-none">Already have an account? Login</a>
        </div>
    </form>
</div>
@endsection

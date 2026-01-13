@extends('layouts.app')

@section('main-col','col-md-12')

@section('content')
{{-- ================== Banner ================== --}}
<div class="text-center py-5" style="background: linear-gradient(135deg, #e47283, #ffe6ea);">
    <img src="{{ asset('logo.png') }}" class="logo mb-3" alt="Logo" width="100">
    <h1 class="mb-2" style="color:#d63384;">Student Counseling Booking System</h1>
    <p class="fst-italic text-muted fs-5">"Your journey to mental wellness starts here"</p>
</div>

{{-- ================== Motivational Quote ================== --}}
<div class="text-center my-5">
    <blockquote class="blockquote fs-5">
        <p class="text-secondary">"Mental health is not a destination, but a process. It's about how you drive, not where you're going."</p>
        <footer class="blockquote-footer">Student Counseling Booking System</footer>
    </blockquote>
</div>

{{-- ================== Services ================== --}}
<div class="row g-4 mb-5 px-3">

    {{-- Appointment Booking --}}
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 text-center p-4" style="background:#fff0f3;">
            <i class="bi bi-calendar-check display-4 mb-3" style="color:#d63384;"></i>
            <h5 class="mb-2 fw-bold">Appointment Booking</h5>
            <p class="text-muted">Book counseling sessions with ease and convenience.</p>
        </div>
    </div>

    {{-- Professional Counselors --}}
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 text-center p-4" style="background:#fff0f3;">
            <i class="bi bi-people display-4 mb-3" style="color:#d63384;"></i>
            <h5 class="mb-2 fw-bold">Professional Counselors</h5>
            <p class="text-muted">Access certified counselors for personal guidance.</p>
        </div>
    </div>

    {{-- Session Management --}}
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 text-center p-4" style="background:#fff0f3;">
            <i class="bi bi-chat-left-text display-4 mb-3" style="color:#d63384;"></i>
            <h5 class="mb-2 fw-bold">Session Management</h5>
            <p class="text-muted">Track your appointments, receive reminders, and manage your sessions.</p>
        </div>
    </div>

</div>

{{-- ================== Call to Action ================== --}}
<div class="text-center mb-5">
    <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-2">Register</a>
    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">Login</a>
</div>

@endsection

@extends('layouts.app')

@section('sidebar')
<div class="col-md-3 col-lg-2 p-0" style="background:#ffd6dc; min-height: 100vh;">
    <div class="p-4 text-center">
        <img src="{{ asset('logo.png') }}" width="70" class="mb-2">
        <h5 style="color:#d63384;">Student Menu</h5>
        <small>"Empower your mind"</small>
    </div>

    <a href="{{ route('student.dashboard') }}" class="d-block mb-2 ps-3 py-2 {{ request()->routeIs('student.dashboard') ? 'bg-danger text-white rounded' : '' }}">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
    </a>

    <a href="{{ route('student.appointments.index') }}" class="d-block mb-2 ps-3 py-2 {{ request()->routeIs('student.appointments.*') ? 'bg-danger text-white rounded' : '' }}">
        <i class="bi bi-calendar-check me-2"></i> My Appointments
    </a>

    <a href="{{ route('student.appointments.create') }}" class="d-block mb-2 ps-3 py-2">
        <i class="bi bi-plus-circle me-2"></i> Book Appointment
    </a>

    <hr>

    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="d-block ps-3 py-2 text-danger">
        <i class="bi bi-box-arrow-right me-2"></i> Logout
    </a>
    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
        @csrf
    </form>
</div>
@endsection

@section('content')
<h3 class="mb-3">Welcome, {{ auth()->user()->name }}</h3>
<p class="text-muted">Your upcoming counseling sessions</p>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6>Total</h6>
                <h3>{{ $total }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center bg-warning text-white">
            <div class="card-body">
                <h6>Pending</h6>
                <h3>{{ $pending }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center bg-success text-white">
            <div class="card-body">
                <h6>Approved</h6>
                <h3>{{ $approved }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center bg-danger text-white">
            <div class="card-body">
                <h6>Rejected</h6>
                <h3>{{ $rejected }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @foreach($appointments as $appointment)
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5>{{ $appointment->counselor->name }}</h5>
                <span class="badge
                    @if($appointment->status=='approved') bg-success
                    @elseif($appointment->status=='pending') bg-warning text-dark
                    @else bg-danger
                    @endif
                ">{{ ucfirst($appointment->status) }}</span>
            </div>
            <p><i class="bi bi-calendar-event me-1"></i> {{ $appointment->appointment_date }}</p>
            <p><i class="bi bi-clock me-1"></i> {{ $appointment->appointment_time }}</p>

            <a href="{{ route('student.appointments.show', $appointment->id) }}" class="btn btn-primary w-100">View Details</a>
        </div>
    </div>
    @endforeach
</div>
@endsection

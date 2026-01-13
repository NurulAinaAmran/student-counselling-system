@extends('layouts.app')
@include('counselor.sidebar')

@section('content')
<div class="container">

    <h3>Welcome, {{ auth()->user()->name }}</h3>
    <p class="text-muted mb-4">Manage student appointments</p>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card text-center p-3" style="background:#ffd6dc;">
                <h6>Total</h6>
                <h4>{{ $total }}</h4>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card text-center p-3 bg-warning text-dark">
                <h6>Pending</h6>
                <h4>{{ $pending }}</h4>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card text-center p-3 bg-success text-white">
                <h6>Approved</h6>
                <h4>{{ $approved }}</h4>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card text-center p-3 bg-danger text-white">
                <h6>Rejected</h6>
                <h4>{{ $rejected }}</h4>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card text-center p-3 bg-info text-white">
                <h6>Completed</h6>
                <h4>{{ $completed }}</h4>
            </div>
        </div>
    </div>

    <!-- Recent Appointments -->
    <h5 class="mb-3">Recent Appointments</h5>

    <div class="row">
        @forelse($appointments as $appointment)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6>{{ $appointment->student->name }}</h6>
                        <span class="badge
                            @if($appointment->status=='approved') bg-success
                            @elseif($appointment->status=='pending') bg-warning text-dark
                            @elseif($appointment->status=='rejected') bg-danger
                            @else bg-info
                            @endif
                        ">{{ ucfirst($appointment->status) }}</span>
                    </div>
                    <p class="mb-1">{{ $appointment->appointment_date }} | {{ $appointment->appointment_time }}</p>
                    <a href="{{ route('counselor.appointments.show', $appointment->id) }}" class="btn btn-sm btn-primary mt-2">
                        View
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">No recent appointments.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection

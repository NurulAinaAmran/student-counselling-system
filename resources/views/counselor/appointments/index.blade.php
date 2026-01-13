@extends('layouts.app')
@include('counselor.sidebar')

@section('content')
<div class="container py-4">
    <h3 class="mb-4" style="color:#d63384;">Appointments</h3>

    <div class="row">
        @forelse($appointments as $appointment)
        <div class="col-md-4">
            <div class="card p-3 mb-3 shadow-sm">
                <h6>{{ $appointment->student->name }}</h6>
                <p>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }} | 
                   {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                <span class="badge 
                    @switch($appointment->status)
                        @case('pending') bg-warning text-dark @break
                        @case('approved') bg-success @break
                        @case('rejected') bg-danger @break
                        @case('completed') bg-primary @break
                        @default bg-secondary @break
                    @endswitch">
                    {{ ucfirst($appointment->status) }}
                </span>

                <a href="{{ route('counselor.appointments.show', $appointment->id) }}"
                   class="btn btn-sm btn-primary mt-2">
                    View
                </a>
            </div>
        </div>
        @empty
        <p>No appointments found.</p>
        @endforelse
    </div>
</div>
@endsection

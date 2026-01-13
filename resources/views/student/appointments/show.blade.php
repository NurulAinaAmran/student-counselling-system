@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">

        {{-- ================= SIDEBAR ================= --}}
        @include('student.sidebar')
        
        {{-- ================= MAIN CONTENT ================= --}}
        <div class="col-md-9 col-lg-10">
        <h3 class="mb-4" style="color:#d63384;">Appointment Details</h3>

        <div class="card p-4 shadow-sm">

        <p><strong>Counselor:</strong> {{ $appointment->counselor->name ?? 'Not assigned' }}</p>
        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</p>
        <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
        <p><strong>Reason:</strong> {{ $appointment->reason ?? 'No reason provided' }}</p>

        <p><strong>Status:</strong>
            <span class="badge 
                @if($appointment->status=='pending') bg-warning text-dark
                @elseif($appointment->status=='approved') bg-success
                @elseif($appointment->status=='rejected') bg-danger
                @else bg-primary
                @endif">
                {{ ucfirst($appointment->status) }}
            </span>
        </p>

        {{-- ACTION BUTTONS --}}
        <div class="d-flex gap-2 mt-4 flex-wrap">
            {{-- EDIT & CANCEL only if pending --}}
            @if($appointment->status === 'pending')
                <a href="{{ route('student.appointments.edit', $appointment) }}" 
                   class="btn btn-warning">
                   Edit Appointment
                </a>

                <form method="POST" action="{{ route('student.appointments.destroy', $appointment) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to cancel this appointment?')">
                        Cancel Appointment
                    </button>
                </form>
            @endif
        
        </div>

    </div>
</div>
@endsection

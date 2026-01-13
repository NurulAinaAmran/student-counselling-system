@extends('layouts.app')
@include('counselor.sidebar')

@section('content')
<div class="container py-4">
    <h3 class="mb-4" style="color:#d63384;">Appointment Details</h3>

    <div class="card p-4 shadow-sm">
        <p><strong>Student:</strong> {{ $appointment->student->name }}</p>
        <p><strong>Email:</strong> {{ $appointment->student->email }}</p>
        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</p>
        <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
        <p><strong>Reason:</strong> {{ $appointment->reason ?? 'No reason provided' }}</p>
        <p><strong>Status:</strong>
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
        </p>

        <form method="POST" action="{{ route('counselor.appointments.update', $appointment->id) }}" class="mt-4">
            @csrf
            @method('PUT')

            <label for="status" class="form-label">Update Status</label>
            <select name="status" id="status" class="form-select mb-3">
                <option value="approved" @if($appointment->status=='approved') selected @endif>Approve</option>
                <option value="rejected" @if($appointment->status=='rejected') selected @endif>Reject</option>
                <option value="completed" @if($appointment->status=='completed') selected @endif>Completed</option>
            </select>

            <div class="d-flex gap-2">
                <button class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">

        {{-- ================= SIDEBAR ================= --}}
        @include('student.sidebar')
        
        {{-- ================= MAIN CONTENT ================= --}}
        <div class="col-md-9 col-lg-10">
        <h2>My Appointments</h2>

    <a href="{{ route('student.appointments.create') }}" class="btn btn-primary mb-3">
        Book Appointment
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        @foreach($appointments as $appointment)
        <tr>
            <td>{{ $appointment->appointment_date }}</td>
            <td>{{ $appointment->appointment_time }}</td>
            <td>{{ ucfirst($appointment->status) }}</td>
            <td>
                <a href="{{ route('student.appointments.show', $appointment) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('student.appointments.edit', $appointment) }}" class="btn btn-warning btn-sm">Edit</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">

        {{-- ================= SIDEBAR ================= --}}
        @include('student.sidebar')

        {{-- ================= MAIN CONTENT ================= --}}
        <div class="col-md-9 col-lg-10">
            <h3 class="mb-4" style="color:#d63384;">Edit Appointment</h3>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('student.appointments.update', $appointment) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="counselor" class="form-label">Counselor</label>
                            <select name="counselor_id" id="counselor" class="form-control" required>
                                @foreach($counselors as $counselor)
                                    <option value="{{ $counselor->id }}"
                                        {{ $appointment->counselor_id == $counselor->id ? 'selected' : '' }}>
                                        {{ $counselor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="appointment_date" value="{{ $appointment->appointment_date }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Time</label>
                            <input type="time" name="appointment_time" value="{{ $appointment->appointment_time }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Reason</label>
                            <textarea name="reason" class="form-control" rows="3">{{ $appointment->reason }}</textarea>
                        </div>

                        <div class="d-flex justify-content-start gap-2">
                            <button type="submit" class="btn btn-warning">Update Appointment</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

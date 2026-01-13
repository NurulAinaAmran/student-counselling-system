@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">

        {{-- ================= SIDEBAR ================= --}}
        @include('student.sidebar')

        {{-- ================= MAIN CONTENT ================= --}}
        <div class="col-md-9 col-lg-10">

            <h3 class="mb-4" style="color:#d63384;">Book a New Appointment</h3>

            {{-- ===== CARD WRAP ===== --}}
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <form method="POST" action="{{ route('student.appointments.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="counselor" class="form-label">Counselor</label>
                            <select name="counselor_id" id="counselor" class="form-select" required>
                                <option value="">Select Counselor</option>
                                @foreach($counselors as $counselor)
                                    <option value="{{ $counselor->id }}">{{ $counselor->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="appointment_date" class="form-label">Date</label>
                            <input type="date" name="appointment_date" id="appointment_date"
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="appointment_time" class="form-label">Time</label>
                            <input type="time" name="appointment_time" id="appointment_time"
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="reason" class="form-label">Reason</label>
                            <textarea name="reason" id="reason" class="form-control"
                                      placeholder="Optional"></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button class="btn btn-primary">Book Appointment</button>
                        </div>
                    </form>

                </div>
            </div>
            {{-- ===== END CARD ===== --}}

        </div>
    </div>
</div>
@endsection

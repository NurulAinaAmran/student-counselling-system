<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentApiController extends Controller
{
    // ---------------- STUDENT ----------------

    // List student's appointments
    public function studentIndex()
    {
        $appointments = Appointment::with('counselor')
            ->where('student_id', Auth::id())
            ->orderBy('appointment_date', 'asc')
            ->get();

        return response()->json($appointments);
    }

    // Show student's appointment
    public function studentShow(Appointment $appointment)
    {
        if ($appointment->student_id != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $appointment->load('counselor');
        return response()->json($appointment);
    }

    // Create appointment
    public function studentStore(Request $request)
    {
        $request->validate([
            'counselor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'reason' => 'nullable|string|max:255',
        ]);

        $appointment = Appointment::create([
            'student_id' => Auth::id(),
            'counselor_id' => $request->counselor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return response()->json($appointment, 201);
    }

    // Update student's appointment (only pending)
    public function studentUpdate(Request $request, Appointment $appointment)
    {
        if ($appointment->student_id != Auth::id() || $appointment->status != 'pending') {
            return response()->json(['message' => 'Cannot update this appointment'], 403);
        }

        $request->validate([
            'counselor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'reason' => 'nullable|string|max:255',
        ]);

        $appointment->update($request->only(['counselor_id','appointment_date','appointment_time','reason']));

        return response()->json($appointment);
    }

    // Delete student's appointment (only pending)
    public function studentDestroy(Appointment $appointment)
    {
        if ($appointment->student_id != Auth::id() || $appointment->status != 'pending') {
            return response()->json(['message' => 'Cannot delete this appointment'], 403);
        }

        $appointment->delete();
        return response()->json(['message' => 'Appointment deleted successfully']);
    }

    // ---------------- COUNSELOR ----------------

    // List all appointments
    public function counselorIndex()
    {
        $appointments = Appointment::with('student')
            ->orderBy('appointment_date', 'asc')
            ->get();

        return response()->json($appointments);
    }

    // Show single appointment
    public function counselorShow(Appointment $appointment)
    {
        $appointment->load('student');
        return response()->json($appointment);
    }

    // Update appointment status
    public function counselorUpdate(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,completed',
        ]);

        $appointment->update([
            'status' => $request->status
        ]);

        return response()->json($appointment);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\User; // <-- Make sure to import User

class AppointmentController extends Controller
{
    // List student's appointments
    public function index()
    {
        $appointments = Appointment::with('counselor')
            ->where('student_id', Auth::id())
            ->orderBy('appointment_date', 'asc')
            ->get();

        return view('student.appointments.index', compact('appointments'));
    }

    // Show form to create a new appointment
    public function create()
    {
        // Fetch all counselors for dropdown
        $counselors = User::where('role', 'counselor')->get();

        return view('student.appointments.create', compact('counselors'));
    }

    // Store new appointment
    public function store(Request $request)
    {
        $request->validate([
            'counselor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'reason' => 'nullable|string|max:255',
        ]);

        Appointment::create([
            'student_id' => Auth::id(),
            'counselor_id' => $request->counselor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'reason' => $request->reason,
            'status' => 'pending', // default
        ]);

        return redirect()->route('student.appointments.index')
                         ->with('success', 'Appointment booked successfully.');
    }

    // Show edit form
    public function edit(Appointment $appointment)
    {
        // Only allow editing if pending
        if ($appointment->status !== 'pending') {
            return redirect()->route('student.appointments.index')
                             ->with('error', 'Only pending appointments can be edited.');
        }

        // Fetch counselors for dropdown
        $counselors = User::where('role', 'counselor')->get();

        return view('student.appointments.edit', compact('appointment', 'counselors'));
    }

    // Update appointment
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'counselor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'reason' => 'nullable|string|max:255',
        ]);

        $appointment->update([
            'counselor_id' => $request->counselor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'reason' => $request->reason,
        ]);

        return redirect()->route('student.appointments.show', $appointment->id)
                         ->with('success', 'Appointment updated successfully.');
    }

    // Show details of a student's appointment
    public function show(Appointment $appointment)
    {
        // Remove authorize check if you don't want policies
        return view('student.appointments.show', compact('appointment'));
    }

    // Delete appointment
    public function destroy(Appointment $appointment)
    {
        if ($appointment->status !== 'pending') {
            return redirect()->route('student.appointments.index')
                             ->with('error', 'Only pending appointments can be canceled.');
        }

        $appointment->delete();

        return redirect()->route('student.appointments.index')
                         ->with('success', 'Appointment canceled successfully.');
    }
}

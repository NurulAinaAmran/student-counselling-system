<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class CounselorController extends Controller
{
    // Dashboard with stats
    public function dashboard()
    {
        $total      = Appointment::count();
        $pending    = Appointment::where('status','pending')->count();
        $approved   = Appointment::where('status','approved')->count();
        $rejected   = Appointment::where('status','rejected')->count();
        $completed  = Appointment::where('status','completed')->count();

        // Pass recent 5 appointments to display on dashboard
        $appointments = Appointment::with('student')
            ->orderBy('appointment_date','desc')
            ->take(5)
            ->get();

        return view('counselor.dashboard', compact(
            'total','pending','approved','rejected','completed','appointments'
        ));
    }

    // List all appointments for counselor
    public function appointments()
    {
        $appointments = Appointment::with('student')
            ->orderBy('appointment_date','asc')
            ->get();

        return view('counselor.appointments.index', compact('appointments'));
    }

    // Show a single appointment and update form
    public function showAppointment(Appointment $appointment)
    {
        $appointment->load('student');

        return view('counselor.appointments.show', compact('appointment'));
    }

    // Update appointment status
    public function updateAppointment(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,completed',
        ]);

        $appointment->update([
            'status' => $request->status
        ]);

        return redirect()->route('counselor.appointments.show', $appointment->id)
                         ->with('success', 'Appointment status updated successfully.');
    }
}

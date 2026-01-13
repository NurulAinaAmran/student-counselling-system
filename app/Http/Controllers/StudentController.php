<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;

class StudentController extends Controller
{
    public function dashboard()
    {
        $studentId = Auth::id();

        // Get all appointments of the student
        $appointments = Appointment::with('counselor')
            ->where('student_id', $studentId)
            ->orderBy('appointment_date', 'asc')
            ->get();

        // Calculate counts for dashboard cards
        $total     = $appointments->count();
        $pending   = $appointments->where('status', 'pending')->count();
        $approved  = $appointments->where('status', 'approved')->count();
        $rejected  = $appointments->where('status', 'rejected')->count();
        $completed = $appointments->where('status', 'completed')->count();

        // Pass all variables to the Blade view
        return view('student.dashboard', compact(
            'appointments',
            'total',
            'pending',
            'approved',
            'rejected',
            'completed'
        ));
    }
}

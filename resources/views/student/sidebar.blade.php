<div class="col-md-3 col-lg-2 p-0 sidebar min-vh-100">
    <div class="p-4">
        <div class="text-center mb-4">
            <img src="{{ asset('logo.png') }}" width="70" class="mb-2">
            <h5 class="fw-bold text-pink">Student Menu</h5>
            <small class="text-muted">"Empower your mind"</small>
        </div>

        <a href="{{ route('student.dashboard') }}"
           class="menu-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="{{ route('student.appointments.index') }}"
           class="menu-link {{ request()->routeIs('student.appointments.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-check"></i> My Appointments
        </a>

        <a href="{{ route('student.appointments.create') }}"
           class="menu-link">
            <i class="bi bi-plus-circle"></i> Book Appointment
        </a>

        <hr>

        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();document.getElementById('logout-form').submit();"
           class="menu-link text-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>

        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
            @csrf
        </form>
    </div>
</div>

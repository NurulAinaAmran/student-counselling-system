@section('sidebar')
<div class="col-md-3 p-4" style="background:#ffd6dc; min-height: 100vh;">
    <div class="text-center mb-4">
        <img src="{{ asset('logo.png') }}" width="80">
        <h5 style="color:#d63384;">Counselor Menu</h5>
    </div>

    <a href="{{ route('counselor.dashboard') }}" class="d-block mb-2">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="{{ route('counselor.appointments.index') }}" class="d-block mb-2">
        <i class="bi bi-calendar-check"></i> Appointments
    </a>

    <a href="{{ route('logout') }}"
       onclick="event.preventDefault();document.getElementById('logout-form').submit();"
       class="d-block mb-2">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
        @csrf
    </form>
</div>
@endsection

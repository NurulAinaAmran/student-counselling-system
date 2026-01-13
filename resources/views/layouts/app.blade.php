<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Counseling Booking System')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body style="background-color:#ffe4e6;">

<div class="container-fluid">
    <div class="row min-vh-100">

        {{-- Sidebar (optional) --}}
        @hasSection('sidebar')
            @yield('sidebar')
            {{-- If sidebar exists, main content takes 9/12 --}}
            <main class="@yield('main-col', 'col-md-9') p-4">
                @yield('content')
            </main>
        @else
            {{-- No sidebar, content full width (or custom col-md-x if defined) --}}
            <main class="@yield('main-col', 'col-md-12 offset-md-0') p-4">
                @yield('content')
            </main>
        @endif

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HotelHub')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark px-4 py-3" style="background:#1a1a2e;">
        <a href="/" class="navbar-brand fw-bold fs-4">🏨 HotelHub</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a href="/rooms" class="nav-link text-white">🏨 Rooms</a>
                </li>
                <li class="nav-item">
                    <a href="/about" class="nav-link text-white">ℹ️ About</a>
                </li>
                <li class="nav-item">
                    <a href="/gallery" class="nav-link text-white">🖼️ Gallery</a>
                </li>
                <li class="nav-item">
                    <a href="/contact" class="nav-link text-white">📞 Contact</a>
                </li>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link text-white dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                🛠️ Admin
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="/admin/rooms">📊 Dashboard</a></li>
                                <li><a class="dropdown-item" href="/admin/bookings">📋 Bookings</a></li>
                                <li><a class="dropdown-item" href="/admin/payments">💳 Payments</a></li>
                                <li><a class="dropdown-item" href="/admin/customers">👥 Customers</a></li>
                                <li><a class="dropdown-item" href="/admin/contacts">📩 Messages</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="/my-bookings" class="nav-link text-white">📋 My Bookings</a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link text-white">👤 {{ auth()->user()->name }}</span>
                        </li>
                    @endif
                    <li class="nav-item">
                        <form method="POST" action="/logout" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm ms-2">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="/login" class="nav-link text-white">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="/register" class="btn btn-warning btn-sm ms-2">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    window.addEventListener('load', function() {
        if (window.location.hash === '#rooms') {
            setTimeout(function() {
                var el = document.getElementById('rooms');
                if (el) el.scrollIntoView({ behavior: 'smooth' });
            }, 300);
        }
    });
    </script>
</body>
</html>
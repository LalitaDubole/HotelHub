@extends('layouts.app')
@section('title', 'Available Rooms')

@section('content')

<!-- Hero Section -->
<section class="text-center py-5" style="background: linear-gradient(135deg, #1a1a2e, #16213e); color:white;">
    <div class="container">
        <h1 class="display-4 fw-bold">Welcome to HotelHub</h1>
        <p class="lead">Luxury stays at affordable prices</p>
        <a href="{{ url('/rooms') }}#rooms" class="btn btn-warning btn-lg mt-3">Browse Rooms</a>
    </div>
</section>

<!-- Audio/Video Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">🎬 Virtual Hotel Tour</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <video controls width="100%" class="rounded shadow">
                    <source src="{{ asset('videos/hotel-tour.mp4') }}" type="video/mp4">
                    Your browser does not support the video element.
                </video>
                <div class="mt-3">
                    <p class="text-muted">🔊 Audio tour:</p>
                    <audio controls class="w-100">
                        <source src="{{ asset('audio/hotel-tour.mp3') }}" type="audio/mpeg">
                    </audio>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Hotel Amenities -->
<section class="py-4">
    <div class="container">
        <h2 class="text-center mb-4">🌟 Hotel Amenities</h2>
        <ul class="list-group list-group-horizontal-md flex-wrap justify-content-center gap-2">
            <li class="list-group-item">🏊 Swimming Pool</li>
            <li class="list-group-item">🍽️ Restaurant</li>
            <li class="list-group-item">💪 Gym</li>
            <li class="list-group-item">🅿️ Free Parking</li>
            <li class="list-group-item">📶 Free WiFi</li>
            <li class="list-group-item">🛎️ 24/7 Room Service</li>
            <li class="list-group-item">🧖 Spa</li>
            <li class="list-group-item">🚌 Airport Shuttle</li>
        </ul>
    </div>
</section>

<!-- Search Section -->
<section class="py-4 bg-light" id="rooms">
    <div class="container">
        <h2 class="text-center mb-4">🔍 Search Rooms</h2>
        <form method="GET" action="{{ route('rooms.index') }}">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control"
                        placeholder="Search by name..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="type" class="form-control">
                        <option value="">All Types</option>
                        <option value="Deluxe" {{ request('type') == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                        <option value="Suite" {{ request('type') == 'Suite' ? 'selected' : '' }}>Suite</option>
                        <option value="Standard" {{ request('type') == 'Standard' ? 'selected' : '' }}>Standard</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="min_price" class="form-control"
                        placeholder="Min Price" value="{{ request('min_price') }}">
                </div>
                <div class="col-md-2">
                    <input type="number" name="max_price" class="form-control"
                        placeholder="Max Price" value="{{ request('max_price') }}">
                </div>
                <div class="col-md-2">
                    <input type="number" name="capacity" class="form-control"
                        placeholder="Guests" value="{{ request('capacity') }}">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-warning w-100">Search</button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Rooms Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Available Rooms</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($rooms as $room)
            <div class="col">
                <div class="card h-100 shadow">
                    <img src="{{ $room->image ? asset($room->image) : asset('images/room1.jpg') }}"
                         alt="{{ $room->name }}" class="card-img-top" style="height:200px; object-fit:cover;">
                    <div class="card-body">
                        <span class="badge bg-{{ $room->status === 'available' ? 'success' : 'danger' }} mb-2">
                            {{ ucfirst($room->status) }}
                        </span>
                        <h5 class="card-title">{{ $room->name }}</h5>
                        <p class="text-muted small">{{ $room->type }}</p>
                        <p class="card-text">{{ Str::limit($room->description, 80) }}</p>
                        <p class="fw-bold text-primary fs-5">
                            ₹{{ number_format($room->price_per_night, 2) }}/night
                        </p>
                        <p class="small text-muted">
                            <i class="fas fa-users"></i> Max: {{ $room->capacity }} guests
                        </p>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="{{ route('rooms.show', $room) }}" class="btn btn-warning w-100">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No rooms found matching your search.</p>
                    <a href="{{ route('rooms.index') }}" class="btn btn-warning mt-2">View All Rooms</a>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
@extends('layouts.app')
@section('title', 'Gallery - HotelHub')

@section('content')

<!-- Hero -->
<section class="py-5 text-center text-white" style="background: linear-gradient(135deg, #1a1a2e, #16213e);">
    <div class="container">
        <h1 class="display-4 fw-bold">Our Gallery</h1>
        <p class="lead">Experience the beauty of HotelHub</p>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Hotel Rooms</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card shadow" style="overflow:hidden;">
                    <img src="{{ asset('images/room1.jpg') }}" class="card-img-top" style="height:200px; object-fit:cover;">
                    <div class="card-body text-center">
                        <p class="fw-bold">Deluxe Ocean View</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow" style="overflow:hidden;">
                    <img src="{{ asset('images/room2.jpg') }}" class="card-img-top" style="height:200px; object-fit:cover;">
                    <div class="card-body text-center">
                        <p class="fw-bold">Presidential Suite</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow" style="overflow:hidden;">
                    <img src="{{ asset('images/room3.jpg') }}" class="card-img-top" style="height:200px; object-fit:cover;">
                    <div class="card-body text-center">
                        <p class="fw-bold">Standard Twin Room</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hotel Amenities Gallery -->
        <h2 class="text-center mb-4 mt-5">Hotel Amenities</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card shadow text-center p-4">
                    <h1>🏊</h1>
                    <p class="fw-bold">Swimming Pool</p>
                </div>
            </div>
            <div class="col">
                <div class="card shadow text-center p-4">
                    <h1>🍽️</h1>
                    <p class="fw-bold">Restaurant</p>
                </div>
            </div>
            <div class="col">
                <div class="card shadow text-center p-4">
                    <h1>💪</h1>
                    <p class="fw-bold">Gym</p>
                </div>
            </div>
            <div class="col">
                <div class="card shadow text-center p-4">
                    <h1>🧖</h1>
                    <p class="fw-bold">Spa</p>
                </div>
            </div>
            <div class="col">
                <div class="card shadow text-center p-4">
                    <h1>🅿️</h1>
                    <p class="fw-bold">Free Parking</p>
                </div>
            </div>
            <div class="col">
                <div class="card shadow text-center p-4">
                    <h1>🚌</h1>
                    <p class="fw-bold">Airport Shuttle</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
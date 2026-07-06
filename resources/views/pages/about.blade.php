@extends('layouts.app')
@section('title', 'About HotelHub')

@section('content')

<!-- Hero -->
<section class="py-5 text-center text-white" style="background: linear-gradient(135deg, #1a1a2e, #16213e);">
    <div class="container">
        <h1 class="display-4 fw-bold">About HotelHub</h1>
        <p class="lead">Luxury stays at affordable prices since 2020</p>
    </div>
</section>

<!-- About Content -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>Who We Are</h2>
                <p class="text-muted">HotelHub is a premium hotel booking platform offering world-class rooms and services. We believe in providing unforgettable experiences to every guest.</p>
                <p class="text-muted">Our hotel features state-of-the-art amenities including swimming pool, spa, gym, restaurant, and 24/7 room service.</p>
                <ul class="list-unstyled mt-3">
                    <li>✅ 100+ Luxury Rooms</li>
                    <li>✅ 24/7 Customer Support</li>
                    <li>✅ Best Price Guarantee</li>
                    <li>✅ Free WiFi & Parking</li>
                </ul>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/room1.jpg') }}" class="img-fluid rounded shadow" alt="About HotelHub">
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3">
                <h2 class="text-warning fw-bold">100+</h2>
                <p>Luxury Rooms</p>
            </div>
            <div class="col-md-3">
                <h2 class="text-warning fw-bold">5000+</h2>
                <p>Happy Guests</p>
            </div>
            <div class="col-md-3">
                <h2 class="text-warning fw-bold">10+</h2>
                <p>Years Experience</p>
            </div>
            <div class="col-md-3">
                <h2 class="text-warning fw-bold">4.8★</h2>
                <p>Average Rating</p>
            </div>
        </div>
    </div>
</section>

@endsection
@extends('layouts.app')
@section('title', 'Contact Us - HotelHub')

@section('content')

<!-- Hero -->
<section class="py-5 text-center text-white" style="background: linear-gradient(135deg, #1a1a2e, #16213e);">
    <div class="container">
        <h1 class="display-4 fw-bold">Contact Us</h1>
        <p class="lead">We'd love to hear from you!</p>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5">
    <div class="container">
        <div class="row">

            <!-- Contact Form -->
            <div class="col-md-7">
                <div class="card shadow p-4">
                    <h3 class="mb-4">Send us a Message</h3>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Send Message</button>
                    </form>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-md-5">
                <div class="card shadow p-4">
                    <h3 class="mb-4">Get In Touch</h3>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt text-warning me-2"></i>
                            <strong>Address:</strong><br>
                            123 Hotel Street, Mumbai, Maharashtra, India
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone text-warning me-2"></i>
                            <strong>Phone:</strong><br>
                            +91 98765 43210
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-envelope text-warning me-2"></i>
                            <strong>Email:</strong><br>
                            info@hotelhub.com
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-clock text-warning me-2"></i>
                            <strong>Working Hours:</strong><br>
                            24/7 Always Open
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
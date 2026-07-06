@extends('layouts.app')
@section('title', $room->name)

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $room->image ? asset($room->image) : asset('images/room1.jpg') }}"
                    class="img-fluid rounded shadow" alt="{{ $room->name }}">
            </div>
            <div class="col-md-6">
                <span class="badge bg-success mb-2">{{ ucfirst($room->status) }}</span>
                <h2>{{ $room->name }}</h2>
                <p class="text-muted">{{ $room->type }}</p>
                <p>{{ $room->description }}</p>
                <p class="fw-bold fs-4 text-primary">₹{{ number_format($room->price_per_night, 2) }}/night</p>
                <p><i class="fas fa-users"></i> Max Guests: {{ $room->capacity }}</p>

                @if($room->amenities)
                <h5 class="mt-3">Amenities</h5>
                <ul class="list-unstyled">
                    @foreach(is_array($room->amenities) ? $room->amenities : explode(',', $room->amenities) as $amenity)
                        <li>✅ {{ trim($amenity) }}</li>
                    @endforeach
                </ul>
                @endif

                @auth
                    @if($room->status === 'available')
                        <a href="{{ route('bookings.create', $room) }}" class="btn btn-warning btn-lg mt-3">
                            Book Now
                        </a>
                    @else
                        <button class="btn btn-secondary btn-lg mt-3" disabled>Not Available</button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-warning btn-lg mt-3">Login to Book</a>
                @endauth
            </div>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="mb-4">⭐ Reviews & Ratings</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Existing Reviews -->
        @forelse($room->reviews()->with('user')->latest()->get() as $review)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="fw-bold">👤 {{ $review->user->name }}</h6>
                    <span class="text-warning">
                        @for($i = 1; $i <= 5; $i++)
                            {{ $i <= $review->rating ? '⭐' : '☆' }}
                        @endfor
                    </span>
                </div>
                <p class="text-muted mb-1">{{ $review->comment }}</p>
                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
            </div>
        </div>
        @empty
            <p class="text-muted">No reviews yet. Be the first to review!</p>
        @endforelse

        <!-- Add Review Form -->
        @auth
        <div class="card shadow mt-4">
            <div class="card-body">
                <h5>Write a Review</h5>
                <form method="POST" action="{{ route('reviews.store', $room) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <select name="rating" class="form-control" required>
                            <option value="">Select Rating</option>
                            <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                            <option value="4">⭐⭐⭐⭐ Very Good</option>
                            <option value="3">⭐⭐⭐ Good</option>
                            <option value="2">⭐⭐ Fair</option>
                            <option value="1">⭐ Poor</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Comment</label>
                        <textarea name="comment" class="form-control" rows="3" required
                            placeholder="Share your experience..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning">Submit Review</button>
                </form>
            </div>
        </div>
        @else
            <div class="alert alert-info mt-3">
                <a href="{{ route('login') }}">Login</a> to write a review.
            </div>
        @endauth
    </div>
</section>

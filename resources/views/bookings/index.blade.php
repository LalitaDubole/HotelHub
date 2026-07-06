@extends('layouts.app')
@section('title', 'My Bookings')

@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="mb-4">My Bookings</h2>

        @forelse($bookings as $booking)
        <div class="card mb-3 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h5>{{ $booking->room->name }}</h5>
                    <p class="mb-1 text-muted">{{ $booking->check_in }} → {{ $booking->check_out }}</p>
                    <p class="mb-1">Guests: {{ $booking->guests }}</p>
                    <p class="fw-bold">₹{{ number_format($booking->total_price, 2) }}</p>
                </div>
                <div>
                    <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'cancelled' ? 'danger' : 'warning') }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
            </div>
        </div>
        @empty
        <p class="text-muted">You have no bookings yet.</p>
        <a href="{{ route('rooms.index') }}" class="btn btn-warning">Browse Rooms</a>
        @endforelse
    </div>
</section>
@endsection
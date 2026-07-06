@extends('layouts.app')
@section('title', 'Booking Confirmed')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h2 class="text-success mb-4">✅ Booking Confirmed!</h2>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <table class="table table-bordered text-start">
                            <tr>
                                <th>Room</th>
                                <td>{{ $booking->room->name }}</td>
                            </tr>
                            <tr>
                                <th>Check-In</th>
                                <td>{{ $booking->check_in }}</td>
                            </tr>
                            <tr>
                                <th>Check-Out</th>
                                <td>{{ $booking->check_out }}</td>
                            </tr>
                            <tr>
                                <th>Guests</th>
                                <td>{{ $booking->guests }}</td>
                            </tr>
                            <tr>
                                <th>Total Price</th>
                                <td>₹{{ number_format($booking->total_price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'cancelled' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                            </tr>
                        </table>

                        <!-- Payment Button -->
                        @if(!$booking->payment)
                            <a href="{{ route('payments.show', $booking) }}" class="btn btn-success btn-lg mt-3">
                                💳 Pay Now ₹{{ number_format($booking->total_price, 2) }}
                            </a>
                        @else
                            <div class="alert alert-success mt-3">
                                ✅ Payment Completed! Transaction ID: {{ $booking->payment->transaction_id }}
                            </div>
                        @endif

                        <a href="{{ route('bookings.mine') }}" class="btn btn-warning mt-3">View My Bookings</a>
                        <a href="{{ route('rooms.index') }}" class="btn btn-outline-primary mt-3">Browse More Rooms</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
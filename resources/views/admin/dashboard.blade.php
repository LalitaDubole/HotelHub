@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">🏨 Admin Dashboard</h2>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <h5>Total Rooms</h5>
                    <h2>{{ $totalRooms }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5>Total Bookings</h5>
                    <h2>{{ $totalBookings }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-white shadow">
                <div class="card-body">
                    <h5>Total Revenue</h5>
                    <h2>₹{{ number_format($totalRevenue, 2) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Rooms Table -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Manage Rooms</h5>
            <a href="{{ route('admin.rooms.create') }}" class="btn btn-warning btn-sm">+ Add New Room</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                    <tr>
                        <td>{{ $room->id }}</td>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->type }}</td>
                        <td>₹{{ number_format($room->price_per_night, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $room->status === 'available' ? 'success' : ($room->status === 'booked' ? 'warning' : 'danger') }}">
                                {{ ucfirst($room->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.rooms.destroy', $room) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this room?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">All Bookings</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Room</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->room->name }}</td>
                        <td>{{ $booking->check_in }}</td>
                        <td>{{ $booking->check_out }}</td>
                        <td>₹{{ number_format($booking->total_price, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'cancelled' ? 'danger' : ($booking->status === 'completed' ? 'info' : 'warning')) }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No bookings yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
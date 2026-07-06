@extends('layouts.app')
@section('title', 'Admin - Rooms')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Admin - Manage Rooms</h2>
            <a href="{{ route('admin.rooms.create') }}" class="btn btn-warning">+ Add New Room</a>
        </div>

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
                        <form method="POST" action="{{ route('admin.rooms.destroy', $room) }}">
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
</section>
@endsection
@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')
@section('title', 'Edit Room')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="mb-4">Edit Room</h2>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('admin.rooms.update', $room) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Room Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $room->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <select name="type" class="form-control" required>
                                    <option value="Deluxe" {{ $room->type === 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                                    <option value="Suite" {{ $room->type === 'Suite' ? 'selected' : '' }}>Suite</option>
                                    <option value="Standard" {{ $room->type === 'Standard' ? 'selected' : '' }}>Standard</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="3" required>{{ $room->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price Per Night (₹)</label>
                                <input type="number" name="price_per_night" class="form-control" value="{{ $room->price_per_night }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Capacity (Guests)</label>
                                <input type="number" name="capacity" class="form-control" value="{{ $room->capacity }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="available" {{ $room->status === 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="booked" {{ $room->status === 'booked' ? 'selected' : '' }}>Booked</option>
                                    <option value="maintenance" {{ $room->status === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Room Image</label>
                                @if($room->image)
                                    <div class="mb-2">
                                        <img src="{{ str_starts_with($room->image, 'images/') ? asset($room->image) : Storage::url($room->image) }}"
                                             style="height:100px; object-fit:cover;" class="rounded">
                                        <p class="small text-muted">Current image</p>
                                    </div>
                                @endif
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Amenities (comma separated)</label>
                                <input type="text" name="amenities" class="form-control"
                                    value="{{ is_array($room->amenities) ? implode(', ', $room->amenities) : $room->amenities }}">
                            </div>
                            <button type="submit" class="btn btn-warning w-100">Update Room</button>
                            <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-secondary w-100 mt-2">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@extends('layouts.app')
@section('title', 'Add New Room')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="mb-4">Add New Room</h2>

                        <form method="POST" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Room Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <select name="type" class="form-control" required>
                                    <option value="Deluxe">Deluxe</option>
                                    <option value="Suite">Suite</option>
                                    <option value="Standard">Standard</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price Per Night (₹)</label>
                                <input type="number" name="price_per_night" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Capacity (Guests)</label>
                                <input type="number" name="capacity" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Room Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Amenities (comma separated)</label>
                                <input type="text" name="amenities" class="form-control" placeholder="WiFi, AC, TV">
                            </div>
                            <button type="submit" class="btn btn-warning w-100">Add Room</button>
                            <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-secondary w-100 mt-2">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
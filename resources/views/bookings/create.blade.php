@extends('layouts.app')
@section('title', 'Book Room')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            {{-- Req #4 - Semantic HTML5 booking form --}}
            <article class="card shadow-lg border-0">
                <header class="card-header bg-primary text-white">
                    <h3 class="mb-0">📅 Book: {{ $room->name }}</h3>
                    <p class="mb-0 small">₹{{ $room->price_per_night }}/night</p>
                </header>

                <section class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Req #10 - Mobile-friendly booking form --}}
                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">

                        <div class="mb-3">
                            <label for="check_in" class="form-label fw-semibold">
                                Check-In Date
                            </label>
                            <input type="date" id="check_in" name="check_in"
                                   class="form-control form-control-lg @error('check_in') is-invalid @enderror"
                                   value="{{ old('check_in') }}"
                                   min="{{ date('Y-m-d') }}"
                                   required>
                            @error('check_in')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="check_out" class="form-label fw-semibold">
                                Check-Out Date
                            </label>
                            <input type="date" id="check_out" name="check_out"
                                   class="form-control form-control-lg @error('check_out') is-invalid @enderror"
                                   value="{{ old('check_out') }}"
                                   required>
                            @error('check_out')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="guests" class="form-label fw-semibold">
                                Number of Guests
                            </label>
                            <input type="number" id="guests" name="guests"
                                   class="form-control form-control-lg @error('guests') is-invalid @enderror"
                                   value="{{ old('guests', 1) }}"
                                   min="1" max="{{ $room->capacity }}"
                                   required>
                            @error('guests')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Max capacity: {{ $room->capacity }} guests</div>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100">
                            ✅ Confirm Booking
                        </button>
                        <a href="{{ route('rooms.index') }}"
                           class="btn btn-outline-secondary btn-lg w-100 mt-2">
                            ← Back to Rooms
                        </a>
                    </form>
                </section>
            </article>

        </div>
    </div>
</div>
@endsection
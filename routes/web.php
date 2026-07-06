<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [RoomController::class, 'index'])->name('home');

// Pages
Route::get('/about', function() {
    return view('pages.about');
})->name('about');

Route::get('/gallery', function() {
    return view('pages.gallery');
})->name('gallery');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Rooms
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

// Bookings & Payments (auth required)
Route::middleware('auth')->group(function () {
    Route::get('/bookings/create/{room}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.mine');

    // Payments
    Route::get('/payments/{booking}', [PaymentController::class, 'show'])->name('payments.show');
    Route::post('/payments/{booking}', [PaymentController::class, 'store'])->name('payments.store');

    // Reviews
    Route::post('/rooms/{room}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User profile
    Route::get('/profile/view', [UserController::class, 'profile'])->name('user.profile');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/rooms', [RoomController::class, 'adminIndex'])->name('admin.rooms.index');
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('admin.rooms.create');
    Route::post('/rooms', [RoomController::class, 'store'])->name('admin.rooms.store');
    Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('admin.rooms.edit');
    Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('admin.rooms.update');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('admin.rooms.destroy');
    Route::get('/bookings', [BookingController::class, 'adminIndex'])->name('admin.bookings.index');
    Route::get('/payments', [PaymentController::class, 'adminIndex'])->name('admin.payments.index');
    Route::get('/customers', [UserController::class, 'adminIndex'])->name('admin.customers.index');
    Route::get('/contacts', [ContactController::class, 'adminIndex'])->name('admin.contacts.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
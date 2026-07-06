<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name', 'type', 'description',
        'price_per_night', 'capacity',
        'image', 'status', 'amenities'
    ];

    protected $casts = ['amenities' => 'array'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function isAvailable($checkIn, $checkOut)
    {
        return !$this->bookings()
            ->where('status', '!=', 'cancelled')
            ->where(function($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                      ->orWhereBetween('check_out', [$checkIn, $checkOut]);
            })->exists();
    }
}
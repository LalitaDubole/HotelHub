<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Room;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Room $room)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Check if user already reviewed this room
        $existing = Review::where('user_id', auth()->id())
                          ->where('room_id', $room->id)
                          ->first();

        if ($existing) {
            return back()->with('error', 'You have already reviewed this room.');
        }

        Review::create([
            'user_id' => auth()->id(),
            'room_id' => $room->id,
            'rating'  => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }
}
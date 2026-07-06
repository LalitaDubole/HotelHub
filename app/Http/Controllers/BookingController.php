<?php
namespace App\Http\Controllers;
use App\Models\Room;
use App\Models\Booking;
use App\Mail\BookingConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Room $room)
    {
        return view('bookings.create', compact('room'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id'   => 'required|exists:rooms,id',
            'check_in'  => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests'    => 'required|integer|min:1',
        ]);

        $room = Room::findOrFail($request->room_id);

        if (!$room->isAvailable($request->check_in, $request->check_out)) {
            return back()->withErrors([
                'check_in' => 'Room is not available for selected dates.'
            ]);
        }

        $nights = \Carbon\Carbon::parse($request->check_in)
                    ->diffInDays($request->check_out);
        $totalPrice = $nights * $room->price_per_night;

        $booking = Booking::create([
            'user_id'     => auth()->id(),
            'room_id'     => $request->room_id,
            'check_in'    => $request->check_in,
            'check_out'   => $request->check_out,
            'guests'      => $request->guests,
            'total_price' => $totalPrice,
            'status'      => 'confirmed',
        ]);

        // Email Confirmation
        try {
            Mail::to(auth()->user()->email)
                ->send(new BookingConfirmation($booking));
        } catch (\Exception $e) {
            // Email fail hone par bhi booking confirm rahegi
        }

        return redirect()->route('bookings.show', $booking)
                         ->with('success', 'Booking confirmed!');
    }

    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    public function myBookings()
    {
        $bookings = Booking::where('user_id', auth()->id())
                           ->with('room')
                           ->latest()
                           ->get();
        return view('bookings.index', compact('bookings'));
    }

    // Admin - All Bookings
    public function adminIndex()
    {
        $bookings = Booking::with(['room', 'user'])
                           ->latest()
                           ->get();
        return view('admin.bookings', compact('bookings'));
    }
}
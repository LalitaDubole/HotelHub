<?php
namespace App\Http\Controllers;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    // Show all rooms with search
    public function index(Request $request)
    {
        $query = Room::where('status', 'available');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('type', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('min_price')) {
            $query->where('price_per_night', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price_per_night', '<=', $request->max_price);
        }

        if ($request->filled('capacity')) {
            $query->where('capacity', '>=', $request->capacity);
        }

        $rooms = $query->get();
        return view('rooms.index', compact('rooms'));
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    // Admin Dashboard
    public function adminIndex()
    {
        $rooms = Room::all();
        $bookings = Booking::with(['room', 'user'])->latest()->get();
        $totalRooms = Room::count();
        $totalBookings = Booking::count();
        $totalRevenue = Booking::where('status', 'confirmed')->sum('total_price');
        return view('admin.dashboard', compact('rooms', 'bookings', 'totalRooms', 'totalBookings', 'totalRevenue'));
    }

    public function create()
    {
        return view('admin.rooms-create');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms-edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'type'            => 'required|string',
            'description'     => 'required',
            'price_per_night' => 'required|numeric|min:1',
            'capacity'        => 'required|integer|min:1',
            'status'          => 'required|in:available,booked,maintenance',
            'image'           => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $imagePath = $room->image;
        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $filename);
            $imagePath = 'images/' . $filename;
        }

        $room->update([
            'name'            => $request->name,
            'type'            => $request->type,
            'description'     => $request->description,
            'price_per_night' => $request->price_per_night,
            'capacity'        => $request->capacity,
            'status'          => $request->status,
            'image'           => $imagePath,
            'amenities'       => $request->amenities,
        ]);

        return redirect()->route('admin.rooms.index')
                         ->with('success', 'Room updated successfully!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'type'            => 'required|string',
            'description'     => 'required',
            'price_per_night' => 'required|numeric|min:1',
            'capacity'        => 'required|integer|min:1',
            'image'           => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $filename);
            $imagePath = 'images/' . $filename;
        }

        Room::create([
            'name'            => $request->name,
            'type'            => $request->type,
            'description'     => $request->description,
            'price_per_night' => $request->price_per_night,
            'capacity'        => $request->capacity,
            'image'           => $imagePath,
            'amenities'       => $request->amenities,
        ]);

        return redirect()->route('admin.rooms.index')
                         ->with('success', 'Room added successfully!');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')
                         ->with('success', 'Room deleted!');
    }
}
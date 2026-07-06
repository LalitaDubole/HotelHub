<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile.view', ['user' => auth()->user()]);
    }

    // Admin - All Customers
    public function adminIndex()
    {
        $customers = User::where('role', 'user')
                        ->withCount('bookings')
                        ->latest()
                        ->get();
        return view('admin.customers', compact('customers'));
    }
}
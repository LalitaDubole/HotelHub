<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Booking $booking)
    {
        return view('payments.checkout', compact('booking'));
    }

    public function store(Request $request, Booking $booking)
    {
        $request->validate([
            'payment_method' => 'required|in:credit_card,debit_card,upi,net_banking',
            'card_number'    => 'required_if:payment_method,credit_card,debit_card',
        ]);

        $transactionId = 'TXN' . strtoupper(uniqid());

        Payment::create([
            'booking_id'     => $booking->id,
            'user_id'        => auth()->id(),
            'amount'         => $booking->total_price,
            'payment_method' => $request->payment_method,
            'status'         => 'completed',
            'transaction_id' => $transactionId,
        ]);

        $booking->update(['status' => 'confirmed']);

        return redirect()->route('bookings.show', $booking)
                         ->with('success', 'Payment successful! Transaction ID: ' . $transactionId);
    }

    public function adminIndex()
    {
        $payments = Payment::with(['booking', 'user'])->latest()->get();
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');
        return view('admin.payments', compact('payments', 'totalRevenue'));
    }
}
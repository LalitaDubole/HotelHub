@extends('layouts.app')
@section('title', 'Payment - HotelHub')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="mb-4">💳 Payment Checkout</h2>

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <!-- Booking Summary -->
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h5>Booking Summary</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Room</th>
                                        <td>{{ $booking->room->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Check-In</th>
                                        <td>{{ $booking->check_in }}</td>
                                    </tr>
                                    <tr>
                                        <th>Check-Out</th>
                                        <td>{{ $booking->check_out }}</td>
                                    </tr>
                                    <tr>
                                        <th>Guests</th>
                                        <td>{{ $booking->guests }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">Total Amount</th>
                                        <td class="text-primary fw-bold">₹{{ number_format($booking->total_price, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Payment Form -->
                        <form method="POST" action="{{ route('payments.store', $booking) }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Payment Method</label>
                                <select name="payment_method" class="form-control" required id="payment_method">
                                    <option value="">Select Payment Method</option>
                                    <option value="credit_card">💳 Credit Card</option>
                                    <option value="debit_card">💳 Debit Card</option>
                                    <option value="upi">📱 UPI</option>
                                    <option value="net_banking">🏦 Net Banking</option>
                                </select>
                            </div>

                            <!-- Card Details -->
                            <div id="card_details" style="display:none;">
                                <div class="mb-3">
                                    <label class="form-label">Card Number</label>
                                    <input type="text" name="card_number" class="form-control"
                                        placeholder="1234 5678 9012 3456" maxlength="19">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Expiry Date</label>
                                        <input type="text" class="form-control" placeholder="MM/YY">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">CVV</label>
                                        <input type="text" class="form-control" placeholder="123" maxlength="3">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Card Holder Name</label>
                                    <input type="text" class="form-control" placeholder="Your Name">
                                </div>
                            </div>

                            <!-- UPI Details -->
                            <div id="upi_details" style="display:none;">
                                <div class="mb-3">
                                    <label class="form-label">UPI ID</label>
                                    <input type="text" class="form-control" placeholder="yourname@upi">
                                </div>
                            </div>

                            <!-- Net Banking -->
                            <div id="bank_details" style="display:none;">
                                <div class="mb-3">
                                    <label class="form-label">Select Bank</label>
                                    <select class="form-control">
                                        <option value="">Select Bank</option>
                                        <option value="sbi">State Bank of India</option>
                                        <option value="hdfc">HDFC Bank</option>
                                        <option value="icici">ICICI Bank</option>
                                        <option value="axis">Axis Bank</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning w-100 btn-lg mt-3">
                                Pay ₹{{ number_format($booking->total_price, 2) }}
                            </button>
                            <a href="{{ route('bookings.show', $booking) }}" class="btn btn-outline-secondary w-100 mt-2">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('payment_method').addEventListener('change', function() {
    document.getElementById('card_details').style.display = 'none';
    document.getElementById('upi_details').style.display = 'none';
    document.getElementById('bank_details').style.display = 'none';

    if (this.value === 'credit_card' || this.value === 'debit_card') {
        document.getElementById('card_details').style.display = 'block';
    } else if (this.value === 'upi') {
        document.getElementById('upi_details').style.display = 'block';
    } else if (this.value === 'net_banking') {
        document.getElementById('bank_details').style.display = 'block';
    }
});
</script>
@endsection
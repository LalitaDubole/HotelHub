@component('mail::message')
# Booking Confirmed! 🎉

Dear **{{ $booking->user->name }}**,

Your booking at **HotelHub** is confirmed.

| Detail | Info |
|--------|------|
| Room | {{ $booking->room->name }} |
| Check-In | {{ $booking->check_in }} |
| Check-Out | {{ $booking->check_out }} |
| Guests | {{ $booking->guests }} |
| Total | ₹{{ $booking->total_price }} |

@component('mail::button', ['url' => url('/bookings/' . $booking->id)])
View Booking
@endcomponent

Thank you for choosing HotelHub!
@endcomponent
<?php
namespace App\Mail;
use App\Models\Booking;
use Illuminate\Mail\Mailable;

class BookingConfirmation extends Mailable
{
    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function envelope()
    {
        return new \Illuminate\Mail\Mailables\Envelope(
            subject: 'HotelHub – Booking Confirmed #' . $this->booking->id,
        );
    }

    public function content()
    {
        return new \Illuminate\Mail\Mailables\Content(
            markdown: 'emails.booking-confirmation',
        );
    }
}
<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class UpdateBookingStatus extends Command
{
    protected $signature = 'bookings:update-status';
    protected $description = 'Mark past bookings as completed';

    public function handle()
    {
        Booking::where('status', 'confirmed')
               ->where('check_out', '<', Carbon::today())
               ->update(['status' => 'completed']);

        $this->info('Booking statuses updated!');
    }
}
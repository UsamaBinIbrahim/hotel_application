<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateBookingStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-booking-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update booking statuses based on check-in and check-out dates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        Booking::where('status', 'upcoming')
            ->whereDate('check_in_date', '<=', $now)
            ->update(['status' => 'in_progress']);
        $completed_bookings = Booking::where('status', '!=', 'completed')
            ->whereDate('check_out_date', '<', $now)
            ->get();
        
        foreach ($completed_bookings as $booking) {
            $booking->status = 'completed';
            $booking->save();

            $hotel = $booking->hotel;
            $hotel->available_rooms += 1;
            $hotel->save();
        }

        $this->info('Booking statuses updated successfully.');
    }
}

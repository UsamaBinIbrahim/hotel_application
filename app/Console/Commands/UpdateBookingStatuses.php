<?php

namespace App\Console\Commands;

use App\Models\BookedRoom;
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
        $now = Carbon::now()->startOfDay();

        Booking::where('status', 'upcoming')
            ->whereDate('check_in_date', '<=', $now)
            ->update(['status' => 'active']);
            
        Booking::where('status', '!=', 'completed')
            ->whereDate('check_out_date', '<=', $now)
            ->update(['status' => 'completed']);

        $this->info('Booking statuses updated successfully.');
    }
}

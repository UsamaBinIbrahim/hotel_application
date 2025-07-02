<?php

namespace App\Http\Controllers;

use App\Models\BookedRoom;
use App\Models\Booking;
use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create(Hotel $hotel) {
        return view('bookings.create', ['hotel' => $hotel]);
    }
    
    public function store(Hotel $hotel, Request $request) {
        $validated = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'check_in' => 'required|date|after:today|before:check_out',
            'check_out' => 'required|date|after:check_in',
            'adults' => 'required|integer|min:1',
            'children' => 'required|integer|min:0'
        ]);

        $adults = $validated['adults'];
        $children = $validated['children'];
        $check_in = $validated['check_in'];
        $check_out = $validated['check_out'];
        
        if($adults + $children > $hotel->max_guests) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(["guests_sum" 
                    => "The total number of guests in {$hotel->name} hotel must not exceed {$hotel->max_guests}"
                ]);
        }

        $unavailable_date = self::checkUnavailableDate($hotel, $check_in, $check_out);
        if($unavailable_date) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'check_in' => "No rooms available on " . $unavailable_date->toFormattedDateString() . " at {$hotel->name} hotel."
                ]);
        }

        $total_price = self::calculateTotalPrice(
            $hotel, 
            $adults,
            $children,
            $check_in, 
            $check_out
        );

        $booking = Booking::create([
            'hotel_id' => $hotel->id,
            'user_id' => Auth::user()->id,
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'total_price' => $total_price,
            'check_in_date' => $check_in,
            'check_out_date' => $check_out,
            'adults' => $adults,
            'children' => $children,
        ]);

        if($booking) {
            self::updateBookedRooms($hotel, $check_in, $check_out);
        }

        return to_route('bookings.index');
    }
    
    public function index() {
        $bookings = Auth::user()->bookings;
        return view('bookings.index', ['bookings' => $bookings]);
    }

    public function show(Booking $booking) {
        return view('bookings.show', ['booking' => $booking]);
    }

    public function destroy(Booking $booking) {
        $booking->delete();
        return to_route('bookings.index');
    }

    private static function checkUnavailableDate(Hotel $hotel, $check_in, $check_out) {
        $carbon_check_in = Carbon::parse($check_in);
        $carbon_check_out = Carbon::parse($check_out);
        for ($date = $carbon_check_in->copy(); $date->lt($carbon_check_out); $date->addDay()) {
            $bookedRoom = BookedRoom::where(['hotel_id'=> $hotel->id,
                    'date' => $date->toDateString()
                ])
                ->first();

            if ($bookedRoom && $bookedRoom->rooms_booked >= $hotel->total_rooms) {
                return $date;
            }
        }
        return null;
    }

    private static function calculateTotalPrice(Hotel $hotel, $adults, $children, $check_in, $check_out) {
        // calculate base count for each of adults and children
        $base_adults = min($adults, $hotel->base_guest_count);
        $remaining_base_slots = $hotel->base_guest_count - $base_adults;
        $base_children = min($children, $remaining_base_slots);
        // calculate extra count for each of adults and children
        $extra_adults = $adults - $base_adults;
        $extra_children = $children - $base_children;
        // calculate number of nights reserved
        $nights = (strtotime($check_out) - strtotime($check_in)) / (60 * 60 * 24);
        // calculate total price
        $total_price = $nights * (
            $hotel->price_per_night 
            + ($extra_adults * $hotel->extra_adult_fee)
            + ($extra_children * $hotel->extra_child_fee) 
        );

        return $total_price;
    }

    private static function updateBookedRooms(Hotel $hotel, $check_in, $check_out) {
        $carbon_check_in = Carbon::parse($check_in);
        $carbon_check_out = Carbon::parse($check_out);
        for ($date = $carbon_check_in->copy(); $date->lt($carbon_check_out); $date->addDay()) {
            $bookedRoom = BookedRoom::firstOrNew([
                'hotel_id' => $hotel->id,
                'date' => $date->toDateString(),
            ]);
            $bookedRoom->rooms_booked += 1;
            $bookedRoom->save();
        }
    }

}
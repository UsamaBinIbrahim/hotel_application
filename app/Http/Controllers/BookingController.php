<?php

namespace App\Http\Controllers;

use App\Models\BookedRoom;
use App\Models\Booking;
use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request) {
        $booking_removed = $request->booking_removed;
        $booking_created = $request->booking_created;
        $bookings = auth()->user()->bookings()->orderBy('check_in_date')->get();
        return view('bookings.index', compact('bookings', 'booking_removed', 'booking_created'));
    }

    public function show(Booking $booking) {
        return view('bookings.show', compact('booking'));
    }

    public function destroy(Booking $booking) {
        $check_in = Carbon::parse($booking->check_in_date);
        $check_out = Carbon::parse($booking->check_out_date);
        for($date = $check_in->copy(); $date->lt($check_out); $date->addDay()) {
            $booked_room = BookedRoom::where([
                'hotel_id' => $booking->hotel_id,
                'date' => $date->toDateString(),
            ])->first();

            if(!$booked_room) {
                continue;
            }

            $booked_room->rooms_booked -= 1;
            if($booked_room->rooms_booked <= 0) {
                $booked_room->delete();
            } else {
                $booked_room->save();
            }
        }
        $booking->delete();
        return response()->json([
            'status' => 'success',
            'bookings_left' => Booking::where('user_id', auth()->id())->count()
        ]);
    }

    public function create(Hotel $hotel) {
        return view('bookings.create', compact('hotel'));
    }
    
    public function store(Hotel $hotel, Request $request) {
        $booking_created = $request->booking_created;
        $validated = $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|string',
            'phone_number' => 'required|string',
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
            'user_id' => auth()->user()->id,
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

        return to_route('bookings.index', compact('booking_created'));
    }

    private static function checkUnavailableDate(Hotel $hotel, $check_in, $check_out) {
        $carbon_check_in = Carbon::parse($check_in);
        $carbon_check_out = Carbon::parse($check_out);
        for ($date = $carbon_check_in->copy(); $date->lt($carbon_check_out); $date->addDay()) {
            $booked_room = BookedRoom::where([
                'hotel_id'=> $hotel->id,
                'date' => $date->toDateString()
            ])->first();

            if ($booked_room && $booked_room->rooms_booked >= $hotel->total_rooms) {
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
            $booked_room = BookedRoom::firstOrNew([
                'hotel_id' => $hotel->id,
                'date' => $date->toDateString(),
            ]);
            $booked_room->rooms_booked += 1;
            $booked_room->save();
        }
    }

}
<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create(Hotel $hotel) {
        return view('booking.create', ['hotel' => $hotel]);
    }

    public function store(Hotel $hotel, Request $request) {
        // if($hotel->available_rooms <= 0) {
        //     return to_route('hotels.index');  how to alert that the bookings failed
        // }

        $validated = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'adults' => 'required|integer|min:1',
            'children' => 'required|integer|min:0'
        ]);
        
        if($validated['adults'] + $validated['children'] > $hotel->max_guests) {
            return redirect()->back()
                            ->withInput()
                            ->withErrors(["guests_sum" => "The total number of guests in {$hotel->name} hotel must not exceed {$hotel->max_guests}"]);
        }
        
        $booking = Booking::create([
            'hotel_id' => $hotel->id,
            'user_id' => Auth::user()->id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'check_in_date' => $request->check_in,
            'check_out_date' => $request->check_out,
            'adults' => $request->adults,
            'children' => $request->children,
        ]);

        if($booking != null) {
            $booking->hotel->available_rooms -= 1;
        }
    }
}

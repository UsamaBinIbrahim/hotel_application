<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function index(Request $request) {
        $filter = trim($request->query('filter', ''));
        $hotels = self::filterQuery($filter);
        return view('hotels.index', compact('hotels', 'filter'));
    }

    public function show(Hotel $hotel, Request $request) {
        return view('hotels.show', ['hotel' => $hotel, $request->back]);
    }

    public function filter(Request $request) {
        Validator::make($request->query(), ['filter' => 'string|nullable|max:255'])
            ->validate();
        $filter = trim($request->query('filter', ''));
        $filtered_hotels = self::filterQuery($filter);
        $html = view('hotels.components.filtered_hotels', compact('filtered_hotels'))->render();
        return response()->json(compact('html'));
    }

    private function filterQuery($filter) {
        $filtered = Hotel::query()
            ->when($filter !== '', fn($query) => $query
                ->where('name', 'like', "%$filter%")
                ->orWhere('location', 'like', "%$filter%")
            )
            ->select('id', 'name', 'location', 'price_per_night', 'main_image')
            ->get();
        return $filtered;
    }
}

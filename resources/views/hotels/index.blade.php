@extends('layouts.app')

@section('title')
  Hotel Booking | Browse Hotels
@endsection

@section('style')
  <link rel="stylesheet" href="{{ asset('styles/profile/index.css') }}">
  <link rel="stylesheet" href="{{asset('styles/hotels/index.css')}}">
@endsection

@section('content')
  <div class="header">
    <h1>Browse Hotels 🏨</h1>
    <p>Find your next destination and explore top-rated stays around the world</p>
  </div>
  
  <div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search by location or name..." />
    <button onclick="filterHotels()">Search</button>
  </div>

  <div class="hotels-container" id="hotelsContainer">
    @foreach ($hotels as $hotel)
        <div class="hotel-card">
            <img src="{{asset('images/hotel.h')}}" alt="{{$hotel->name}}">
            <div class="hotel-info">
                <h3>{{$hotel->name}}</h3>
                <p><i data-lucide="map-pin"></i> {{$hotel->location}}</p>
                <p><i data-lucide="circle-dollar-sign"></i> <span>${{$hotel->price_per_night}}/night</span></p>
                <button onclick="window.location.href='{{route('hotels.show', ['hotel' => $hotel->id, 'back' => url()->current()])}}'">
                  <i data-lucide="eye"></i> View Details
                </button>
            </div>
        </div>
    @endforeach
  </div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      lucide.createIcons();
    });
  </script>
@endsection
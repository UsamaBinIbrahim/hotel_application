@extends('layouts.app')

@section('title')
  Hotel Booking | Home
@endsection

@section('style')
  <link rel="stylesheet" href="{{asset('styles/homepage.css')}}">
@endsection  

@section('content')
  <div class="hero">
    Discover top-rated hotels at the best prices
  </div>

  <section id="hotels">
    @foreach ($hotels as $hotel)
      <a href="{{route('hotels.show', $hotel->id)}}" class="hotel-link">
        <div class="hotel">
          <div class="hotel-photo">
            <img src="{{asset('images/hotel.h')}}" alt="{{$hotel->name}}">
          </div>
          <div class="hotel-info">
            <h3>{{$hotel->name}}</h3>
            <p>{{$hotel->location}}</p>
            <p>Price: <span>{{$hotel->price_per_night}}/night</span></p>
          </div>
        </div>
      </a>
    @endforeach
    <div id="show-all-hotels" onclick="window.location.href='{{route('hotels.index')}}'">
        Show All Hotels <span>&ThinSpace;&#x2192;</span>
    </div>
  </section>
  
  <section class="features">
    <div class="feature">
      <h3>Easy Booking</h3>
      <p>Book hotels in just a few clicks with real-time availability.</p>
    </div>
    <div class="feature">
      <h3>Secure Payments</h3>
      <p>All transactions are encrypted and handled safely.</p>
    </div>
    <div class="feature">
      <h3>Verified Reviews</h3>
      <p>Read genuine reviews from other travelers before booking.</p>
    </div>
  </section>
@endsection
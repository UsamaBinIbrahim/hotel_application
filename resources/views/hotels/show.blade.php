@extends('layouts.app')

@section('title')
    Hotel Details | Hotel Booking
@endsection

@section('style')
  <link rel="stylesheet" href="{{asset('styles/hotels/show.css')}}">
@endsection

@section('content')
  <div class="images-container">
    <div class="slider-wrapper">
      <div class="slider">
        <img id="slide-1" src="{{asset('images/hotel.h')}}" alt="Hotel Image" />
        <img id="slide-2" src="{{asset('images/hotel.h')}}" alt="Hotel Image" />
        <img id="slide-3" src="{{asset('images/hotel.h')}}" alt="Hotel Image" />
      </div>
      <div class="slider-nav">
        <a href="#slide-1"></a>
        <a href="#slide-2"></a>
        <a href="#slide-3"></a>
      </div>
    </div>
  </div>
  <div class="hotel-container">
    <h2>{{$hotel->name}}</h2>
    <div class="flex-container">
      <div class="hotel-info-grid">
        <div class="info-card">
            <h4>Location</h4>
            <span class="location">{{$hotel->location}}</span>
        </div>
        <div class="info-card">
            <h4>Amenities</h4>
            <ul>
                @foreach ($amenities as $amenity)
                    <li>{{$amenity}}</li>
                @endforeach
            </ul>
        </div>
        <div class="info-card description">
            <h4>Description</h4>
            <p>{{$hotel->description}}</p>
        </div>
      </div>

      <button type="button" class="book-now" onclick="window.location.href='{{route('booking.create', $hotel->id)}}'">
          Book Now for ${{$hotel->price_per_night}}
      </button>
    </div>
    <div class="reviews">
        <h3>Guest Reviews</h3>
        <p><strong>Rating:</strong> 4.5/5</p>
        <p>“A fantastic stay! The staff were wonderful, and the views were incredible.” - John Doe</p>
        <p>“Highly recommend this resort for anyone visiting Beirut. Great amenities!” - Jane Smith</p>
    </div>
  </div>
@endsection
@extends('layouts.app')

@section('title')
    Hotel Details | Hotel Booking
@endsection

@section('style')
  <link rel="stylesheet" href="{{asset('/styles/hotels/show.css')}}">
@endsection

@section('content')
  <div class="hotel-container">
    <h2>Sunrise Resort</h2>

    <div class="hotel-details">
      <img src="{{asset('/images/' . $hotel->image)}}" alt="Hotel Image" />

      <div class="hotel-info">
        <h3>About the Hotel</h3>
        <p><strong>Location:</strong> {{$hotel->location}} </p>
        <p><strong>Price per Night:</strong> ${{$hotel->price_per_night}}</p>
        <p><strong>Amenities:</strong></p>
        <ul>
            @foreach ($amenities as $amenity)
                <li>{{$amenity}}</li>
            @endforeach
        </ul>
        <p><strong>Description:</strong>{{$hotel->description}}</p>

        <button class="book-now-btn" onclick="window.location.href='{{route('booking.create', $hotel->id)}}'">Book Now</button>
      </div>
    </div>

    <h3>Guest Reviews</h3>
    <p><strong>Rating:</strong> 4.5/5</p>
    <p>“A fantastic stay! The staff were wonderful, and the views were incredible.” - John Doe</p>
    <p>“Highly recommend this resort for anyone visiting Beirut. Great amenities!” - Jane Smith</p>
  </div>
@endsection
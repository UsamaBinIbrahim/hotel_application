@extends('layouts.app')

@section('title')
  Hotel Booking | Hotel Details
@endsection

@section('style')
  <link rel="stylesheet" href="{{asset('styles/hotels/show.css')}}">
@endsection

@section('content')
  <div style="max-width: 1200px; margin: 1.5rem auto 0; padding: 0 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
  <a href="{{ request('back', route('hotels.index')) }}" class="back-button" style="display: flex; align-items: center; gap: 0.5rem;">
    <i data-lucide="arrow-left"></i> Back
  </a>

  <form method="POST" action="#">
    @csrf
    <button type="button" class="add-fav-btn">
      <i data-lucide="heart"></i> Add to Favorites
    </button>
  </form>
</div>


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

      <button type="button" class="book-now" onclick="window.location.href='{{route('bookings.create', $hotel->id)}}'">
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

  <script>
    lucide.createIcons();
  </script>
@endsection
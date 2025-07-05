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
  @php
      info(request('back', route('hotels.index')));
  @endphp

  @if (auth()->check())
    @php $is_favorite = auth()->user()->favoriteHotels->contains($hotel->id) @endphp  
    <button type="button" id="toggle-btn" class="{{$is_favorite? 'fav-btn': 'unfav-btn'}}">
      <i id="toggle-data-lucide" data-lucide="{{$is_favorite? 'heart': 'heart-off'}}"></i>
    </button>
  @endif
</div>


  <div class="images-container">
    <div class="slider-wrapper">
      <div class="slider">
        @foreach ($hotel->images as $image)
          <img id="slide-{{ $loop->iteration }}" src="{{ asset('storage/' . $image) }}" alt="Hotel Image" />
        @endforeach
      </div>

      <div class="slider-nav">
        @foreach ($hotel->images as $image)
          <a href="#slide-{{ $loop->iteration }}"></a>
        @endforeach
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
                @foreach ($hotel->amenities as $amenity)
                    <li>{{$amenity->name}}</li>
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
@endsection

@section('scripts')
  <script>
    $(window).on('pageshow', function() {
      const userLogged = {{auth()->check() == true? 1: 0}};
      if(userLogged) {
        const toggleBtn = $('#toggle-btn');
        const toggleLucideData = $('#toggle-data-lucide');
        const url = '{{route('favorites.check', ':hotelId')}}'.replace(':hotelId', {{$hotel->id}});
        $.ajax({
          url: url,
          method: 'GET',
          dataType: 'json',
          success: function(response) {
            const isFavorite = response.is_favorite;
            if (isFavorite) {
              toggleBtn.attr('class', 'fav-btn');
              toggleLucideData.attr('data-lucide', 'heart');
            } else {
              toggleBtn.attr('class', 'unfav-btn');
              toggleLucideData.attr('data-lucide', 'heart-off');
            }
            lucide.createIcons();
          },
        });
      }
    });
    $(document).ready(function() {
      lucide.createIcons();

      $(document).on('click', '#toggle-btn', function(e) {
        e.preventDefault();
        const url = '{{route('favorites.toggle', ':hotelId')}}'.replace(':hotelId', {{$hotel->id}});
        $.ajax({
          url: url,
          method: 'POST',
          dataType: 'json',
          success: function(response) {
            $('#toggle-btn').attr('class', response.class);
            $('#toggle-data-lucide').attr('data-lucide', response.data_lucide);
            lucide.createIcons();
          },
        });
        $('#toggle-btn').removeAttr('disabled');
      });
    });
  </script>
@endsection
@extends('layouts.app')

@section('title')
  Hotel Booking | Favorite Hotels
@endsection

@section('style')
  <link rel="stylesheet" href="{{ asset('styles/profile/index.css') }}">
  <link rel="stylesheet" href="{{ asset('styles/profile/favorites/index.css') }}">
@endsection

@section('content')
  <div class="main-container">
    <div class="header">
      <h1>Your Favorite Hotels ❤️</h1>
      <p>Manage your saved places and discover new destinations you'll love</p>
    </div>

    <div class="favorites-grid">
      @foreach ($favorite_hotels as $hotel)
        <div class="favorite-card" id="hotel_{{$hotel->id}}">
          <img src="{{asset('storage/' . $hotel->main_image)}}" alt="{{$hotel->name}}">
          <div class="favorite-info">
            <h3>{{$hotel->name}}</h3>
            <p><i data-lucide="map-pin"></i> {{$hotel->location}}</p>
            <p><i data-lucide="star"></i> 4.8 / 5.0</p>
            <button onclick="window.location.href='{{route('hotels.show', ['hotel' => $hotel->id, 'back' => url()->current()])}}'" class="view-btn">
              <i data-lucide="eye"></i> View Details
            </button>
              <button class="remove-btn" data-hotel-id="{{$hotel->id}}">
                <i data-lucide="heart-off"></i> Remove
              </button>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      lucide.createIcons();

      $('.remove-btn').on('click', function() {
        $(this).attr('disabled', true);
        const hoteId = $(this).data('hotel-id');
        const url = '{{route('favorites.destroy', ['hotel' => ':hotelId'])}}'.replace(':hotelId', hoteId);
        $.ajax({
          url: url,
          method: 'DELETE',
          dataType: 'json',
          success: function(response) {
            $('#hotel_' + hoteId).remove();
          },
          error: function(error) {
            console.log(error.message);
          }
        });
        $(this).removeAttr('disabled');
      });
    });
  </script>
@endsection
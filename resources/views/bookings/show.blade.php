@extends('layouts.app')

@section('title')
  Hotel Booking | Booking Details
@endsection

@section('style')
  <link rel="stylesheet" href="{{ asset('styles/bookings/show.css') }}">
@endsection

@section('content')
<div class="booking-container">
  <div class="booking-header" onclick="window.location.href='{{route('hotels.show', ['hotel' => $booking->hotel->id, 'back' => url()->current()])}}'">
    <img src="{{asset('storage/' . $booking->hotel->main_image)}}" alt="{{$booking->hotel->name}}">
    <div class="overlay">
      <h1>{{$booking->hotel->name}}</h1>
      <p><i data-lucide="map-pin"></i> {{$booking->hotel->location}}</p>
    </div>
  </div>

  <div class="booking-details">
    <div class="info-section">
      <h2>Booking Information</h2>
      <div class="info-pair"><strong>Status:</strong> <span class="status {{strtolower($booking->status)}}">{{$booking->status}}</span></div>
      <div class="info-pair"><strong>Check-in Date:</strong> {{$booking->check_in_date->format('Y-m-d')}}</div>
      <div class="info-pair"><strong>Check-out Date:</strong> {{$booking->check_out_date->format('Y-m-d')}}</div>
      <div class="info-pair"><strong>Guests:</strong> {{$booking->adults}} {{'Adults'}}@if ($booking->children > 0), {{$booking->children}} Child @endif
      </div>
      <div class="info-pair"><strong>Total Price:</strong> ${{$booking->total_price}}</div>
    </div>

    <div class="action">
      <a href="{{ route('bookings.index') }}" class="button gray full">
        <i data-lucide="arrow-left"></i> Go Back
      </a>
      @if ($booking->status == 'upcoming')
        <button type="button" class="button red full" id="delete-btn">
          <i data-lucide="trash-2"></i> Cancel Booking
        </button>
      @endif
    </div>
  </div>
</div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      lucide.createIcons();

      $('#delete-btn').on('click', async function() {
        $('#delete-btn').attr('disabled', true);
        const url = '{{route('bookings.destroy', ['booking' => ':bookingId'])}}'.replace(':bookingId', {{$booking->id}});
        const isConfirmed = await alertWarning({text: 'Are you sure you want to perform this action?'});
        if(!isConfirmed) {
          $('#delete-btn').removeAttr('disabled');
          return;
        }

        $.ajax({
          url: url,
          method: 'DELETE',
          success: function(response) {
            response.bookings_left > 0
              ? window.location.href='{{route('bookings.index', ['booking_removed' => true])}}'
              : window.location.href='{{route('profile.index', ['booking_removed' => true])}}';
          },
          error: function() {
            alertError();
          }
        });
      });
    });
  </script>
@endsection
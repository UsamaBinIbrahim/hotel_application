@extends('layouts.app')

@section('title')
  Hotel Booking | Booking Details
@endsection

@section('style')
  <link rel="stylesheet" href="{{ asset('styles/bookings/show.css') }}">
@endsection

@section('content')
<div class="booking-container">
  <div class="booking-header">
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
      <div class="info-pair"><strong>Check-in Date:</strong> {{$booking->check_in_date}}</div>
      <div class="info-pair"><strong>Check-out Date:</strong> {{$booking->check_out_date}}</div>
      <div class="info-pair"><strong>Guests:</strong> {{$booking->adults}} {{'Adults'}}@if ($booking->children > 0), {{$booking->children}} Child @endif
      </div>
      <div class="info-pair"><strong>Total Price:</strong> ${{$booking->total_price}}</div>
    </div>

    <div class="action">
      <a href="{{ route('bookings.index') }}" class="button gray full">
        <i data-lucide="arrow-left"></i> Go Back
      </a>
      @if ($booking->status == 'upcoming' || $booking->status == 'completed')
        <button type="button" class="button red full" id="delete-btn">
          <i data-lucide="trash-2"></i> {{$booking->status == 'completed'? 'Delete': 'Cancel'}} Booking
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

      $('#delete-btn').on('click', function() {
        $('#delete-btn').attr('disabled', true);
        const url = '{{route('bookings.destroy', ['booking' => ':bookingId'])}}'.replace(':bookingId', {{$booking->id}})
        
        $.ajax({
          url: url,
          method: 'DELETE',
          success: function(response) {
            const bookingStatus = '{{$booking->status}}';
            const action = (() => {
              if(bookingStatus === 'completed') return 'deleted';
              if(bookingStatus === 'upcoming') return 'canceled';
              return '';
            })();
            alertSuccess({title: 'Booking ' + action, text: 'Booking has been ' + action + ' successfully.'});
            setTimeout(() => {
              response.bookings_left > 0
                ? window.location.href='{{route('bookings.index')}}'
                : window.location.href='{{route('profile.index')}}';
            }, 1000);
          },
          error: function(error) {
          }
        });
      });
    });
  </script>
@endsection
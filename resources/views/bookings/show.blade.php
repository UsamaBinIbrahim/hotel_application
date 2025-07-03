@extends('layouts.app')

@section('title')
  Booking Details
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
        <form method="POST" action="{{route('bookings.destroy', $booking->id)}}">
          @csrf
          @method('DELETE')
          <button type="submit" class="button red full">
            <i data-lucide="trash-2"></i> {{$booking->status == 'completed'? 'Delete': 'Cancel'}} Booking
          </button>
        </form>
      @endif
    </div>
  </div>
</div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      lucide.createIcons();
    });
  </script>
@endsection
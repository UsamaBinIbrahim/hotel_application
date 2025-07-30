@extends('layouts.app')

@section('title')
  Hôtelys | My Bookings
@endsection

@section('style')  
  <link rel="stylesheet" href="{{asset('styles/bookings/index.css')}}" />
@endsection

@section('content')
<div class="main-container">
  <div class="header">
    <h1>Your Bookings</h1>
    <p>View and manage your hotel reservations</p>
  </div>
    
  <div class="bookings-container">
    @foreach ($bookings as $booking)
      <div class="booking-card">
        <img src="{{ asset('storage/' . $booking->hotel->main_image) }}" alt="{{$booking->hotel->name}}">
        <div class="booking-info">
          <h3>{{ $booking->hotel->name }}</h3>
          <p><i data-lucide="map-pin"></i> {{ $booking->hotel->location }}</p>
          <p><strong>Check-in:</strong> {{ $booking->check_in_date->format('Y-m-d') }}</p>
          <p><strong>Check-out:</strong> {{ $booking->check_out_date->format('Y-m-d') }}</p>
          <p><strong>Status:</strong> <span class="status {{ strtolower($booking->status) }}">{{ $booking->status }}</span></p>
          <button onclick="window.location.href='{{ route('bookings.show', $booking->id) }}'">
            <i data-lucide="eye"></i> View Details
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
      const bookingRemoved = {{$booking_removed ?? 'false'}};
      const bookingCreated = {{$booking_created ?? 'false'}};
      if(bookingRemoved) {alertSuccess({title: 'Booking removed', text: 'Booking has been removed successfully.'});}
      if(bookingCreated) {alertSuccess({title: 'Booking reserved', text: 'Booking has been reserved successfully'})}

      lucide.createIcons();
    });
  </script>
@endsection
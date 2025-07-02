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
    <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=1000&h=400&fit=crop" alt="Hotel Image">
    <div class="overlay">
      <h1>Ocean View Resort</h1>
      <p><i data-lucide="map-pin"></i> Miami, FL</p>
    </div>
  </div>

  <div class="booking-details">
    <div class="info-section">
      <h2>Booking Information</h2>
      <div class="info-pair"><strong>Status:</strong> <span class="status completed">Completed</span></div>
      <div class="info-pair"><strong>Check-in Date:</strong> July 2, 2025</div>
      <div class="info-pair"><strong>Check-out Date:</strong> July 6, 2025</div>
      <div class="info-pair"><strong>Guests:</strong> 2 Adults, 1 Child</div>
      <div class="info-pair"><strong>Total Price:</strong> $720.00</div>
    </div>

    <div class="info-section">
      <h2>Hotel Info</h2>
      <div class="info-pair"><strong>Hotel Name:</strong> Ocean View Resort</div>
      <div class="info-pair"><strong>Location:</strong> Miami, FL</div>
      <div class="info-pair"><strong>Rating:</strong> 4.9</div>
    </div>

    <div class="action">
        <a href="{{ route('bookings.index') }}" class="button gray full">
          <i data-lucide="arrow-left"></i> Go Back
        </a>
      <form method="POST" action="#">
        @csrf
        @method('DELETE')
        <button type="submit" class="button red full">
          <i data-lucide="trash-2"></i> Delete Booking
        </button>
      </form>
    </div>
  </div>
</div>

<script>
  lucide.createIcons();
</script>
@endsection

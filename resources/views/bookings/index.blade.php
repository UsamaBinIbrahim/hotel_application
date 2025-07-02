<!-- resources/views/bookings/index.blade.php -->
@extends('layouts.app')

@section('title')
  Hotel Booking | My Bookings
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
            <p><strong>Check-in:</strong> {{ $booking->check_in_date }}</p>
            <p><strong>Check-out:</strong> {{ $booking->check_out_date }}</p>
            <p><strong>Status:</strong> <span class="status {{ strtolower($booking->status) }}">{{ $booking->status }}</span></p>
            <button onclick="window.location.href='{{ route('bookings.show', $booking->id) }}'">
              <i data-lucide="eye"></i> View Details
            </button>
          </div>
        </div>
      @endforeach
      {{-- <div class="booking-card">
  <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&h=600&fit=crop&crop=center" alt="Grand Plaza Hotel">
  <div class="booking-info">
    <h3>Grand Plaza Hotel</h3>
    <p><i data-lucide="map-pin"></i> New York, NY</p>
    <p><strong>Check-in:</strong> 2025-07-05</p>
    <p><strong>Check-out:</strong> 2025-07-10</p>
    <p><strong>Status:</strong> <span class="status upcoming">Upcoming</span></p>
    <button onclick="window.location.href='{{route('bookings.show')}}'">
      <i data-lucide="eye"></i> View Details
    </button>
  </div>
</div>

<div class="booking-card">
  <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&h=600&fit=crop&crop=center" alt="Ocean View Resort">
  <div class="booking-info">
    <h3>Ocean View Resort</h3>
    <p><i data-lucide="map-pin"></i> Miami, FL</p>
    <p><strong>Check-in:</strong> 2025-06-20</p>
    <p><strong>Check-out:</strong> 2025-06-25</p>
    <p><strong>Status:</strong> <span class="status in-progress">In Progress</span></p>
    <button onclick="window.location.href='{{route('bookings.show')}}'">
      <i data-lucide="eye"></i> View Details
    </button>
  </div>
</div>

<div class="booking-card">
  <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&h=600&fit=crop&crop=center" alt="Mountain Lodge">
  <div class="booking-info">
    <h3>Mountain Lodge</h3>
    <p><i data-lucide="map-pin"></i> Aspen, CO</p>
    <p><strong>Check-in:</strong> 2025-05-10</p>
    <p><strong>Check-out:</strong> 2025-05-14</p>
    <p><strong>Status:</strong> <span class="status completed">Completed</span></p>
    <button onclick="window.location.href='{{route('bookings.show')}}'">
      <i data-lucide="eye"></i> View Details
    </button>
  </div>
</div>
<div class="booking-card">
  <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&h=600&fit=crop&crop=center" alt="Grand Plaza Hotel">
  <div class="booking-info">
    <h3>Grand Plaza Hotel</h3>
    <p><i data-lucide="map-pin"></i> New York, NY</p>
    <p><strong>Check-in:</strong> 2025-07-05</p>
    <p><strong>Check-out:</strong> 2025-07-10</p>
    <p><strong>Status:</strong> <span class="status upcoming">Upcoming</span></p>
    <button onclick="window.location.href='{{route('bookings.show')}}'">
      <i data-lucide="eye"></i> View Details
    </button>
  </div>
</div>

<div class="booking-card">
  <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&h=600&fit=crop&crop=center" alt="Ocean View Resort">
  <div class="booking-info">
    <h3>Ocean View Resort</h3>
    <p><i data-lucide="map-pin"></i> Miami, FL</p>
    <p><strong>Check-in:</strong> 2025-06-20</p>
    <p><strong>Check-out:</strong> 2025-06-25</p>
    <p><strong>Status:</strong> <span class="status in-progress">In Progress</span></p>
    <button onclick="window.location.href='{{route('bookings.show')}}'">
      <i data-lucide="eye"></i> View Details
    </button>
  </div>
</div>

<div class="booking-card">
  <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&h=600&fit=crop&crop=center" alt="Mountain Lodge">
  <div class="booking-info">
    <h3>Mountain Lodge</h3>
    <p><i data-lucide="map-pin"></i> Aspen, CO</p>
    <p><strong>Check-in:</strong> 2025-05-10</p>
    <p><strong>Check-out:</strong> 2025-05-14</p>
    <p><strong>Status:</strong> <span class="status completed">Completed</span></p>
    <button onclick="window.location.href='{{route('bookings.show')}}'">
      <i data-lucide="eye"></i> View Details
    </button>
  </div>
</div>
<div class="booking-card">
  <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&h=600&fit=crop&crop=center" alt="Grand Plaza Hotel">
  <div class="booking-info">
    <h3>Grand Plaza Hotel</h3>
    <p><i data-lucide="map-pin"></i> New York, NY</p>
    <p><strong>Check-in:</strong> 2025-07-05</p>
    <p><strong>Check-out:</strong> 2025-07-10</p>
    <p><strong>Status:</strong> <span class="status upcoming">Upcoming</span></p>
    <button onclick="window.location.href='{{route('bookings.show')}}'">
      <i data-lucide="eye"></i> View Details
    </button>
  </div>
</div>

<div class="booking-card">
  <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&h=600&fit=crop&crop=center" alt="Ocean View Resort">
  <div class="booking-info">
    <h3>Ocean View Resort</h3>
    <p><i data-lucide="map-pin"></i> Miami, FL</p>
    <p><strong>Check-in:</strong> 2025-06-20</p>
    <p><strong>Check-out:</strong> 2025-06-25</p>
    <p><strong>Status:</strong> <span class="status in-progress">In Progress</span></p>
    <button onclick="window.location.href='{{route('bookings.show')}}'">
      <i data-lucide="eye"></i> View Details
    </button>
  </div>
</div>

<div class="booking-card">
  <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&h=600&fit=crop&crop=center" alt="Mountain Lodge">
  <div class="booking-info">
    <h3>Mountain Lodge</h3>
    <p><i data-lucide="map-pin"></i> Aspen, CO</p>
    <p><strong>Check-in:</strong> 2025-05-10</p>
    <p><strong>Check-out:</strong> 2025-05-14</p>
    <p><strong>Status:</strong> <span class="status completed">Completed</span></p>
    <button onclick="window.location.href='{{route('bookings.show')}}'">
      <i data-lucide="eye"></i> View Details
    </button>
  </div>
</div>
<div class="booking-card">
  <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&h=600&fit=crop&crop=center" alt="Grand Plaza Hotel">
  <div class="booking-info">
    <h3>Grand Plaza Hotel</h3>
    <p><i data-lucide="map-pin"></i> New York, NY</p>
    <p><strong>Check-in:</strong> 2025-07-05</p>
    <p><strong>Check-out:</strong> 2025-07-10</p>
    <p><strong>Status:</strong> <span class="status upcoming">Upcoming</span></p>
    <button onclick="window.location.href='{{route('bookings.show')}}'">
      <i data-lucide="eye"></i> View Details
    </button>
  </div>
</div>

<div class="booking-card">
  <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&h=600&fit=crop&crop=center" alt="Ocean View Resort">
  <div class="booking-info">
    <h3>Ocean View Resort</h3>
    <p><i data-lucide="map-pin"></i> Miami, FL</p>
    <p><strong>Check-in:</strong> 2025-06-20</p>
    <p><strong>Check-out:</strong> 2025-06-25</p>
    <p><strong>Status:</strong> <span class="status in-progress">In Progress</span></p>
    <button onclick="window.location.href='{{route('bookings.show')}}'">
      <i data-lucide="eye"></i> View Details
    </button>
  </div>
</div>

<div class="booking-card">
  <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&h=600&fit=crop&crop=center" alt="Mountain Lodge">
  <div class="booking-info">
    <h3>Mountain Lodge</h3>
    <p><i data-lucide="map-pin"></i> Aspen, CO</p>
    <p><strong>Check-in:</strong> 2025-05-10</p>
    <p><strong>Check-out:</strong> 2025-05-14</p>
    <p><strong>Status:</strong> <span class="status completed">Completed</span></p>
    <button onclick="window.location.href='{{route('bookings.show')}}'">
      <i data-lucide="eye"></i> View Details
    </button>
  </div>
</div>
 --}}
  </div>
</div>

<script>
  lucide.createIcons();
</script>
@endsection

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
    <!-- Header -->
    <div class="header">
      <h1>Your Favorite Hotels ❤️</h1>
      <p>Manage your saved places and discover new destinations you'll love</p>
    </div>

    <!-- Favorites Grid -->
    <div class="favorites-grid">
      <div class="favorite-card">
        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&h=600&fit=crop&crop=center" alt="Grand Plaza Hotel">
        <div class="favorite-info">
          <h3>Grand Plaza Hotel</h3>
          <p><i data-lucide="map-pin"></i> New York, NY</p>
          <p><i data-lucide="star"></i> 4.8 / 5.0</p>
          <button onclick="window.location.href='{{route('hotels.show', ['hotel' => 16, 'back' => url()->current()])}}'" class="view-btn"><i data-lucide="eye"></i> View Details</button>
          <button class="remove-btn"><i data-lucide="heart-off"></i> Remove</button>
        </div>
        </div>

      <div class="favorite-card">
        <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&h=600&fit=crop&crop=center" alt="Ocean View Resort">
        <div class="favorite-info">
          <h3>Ocean View Resort</h3>
          <p><i data-lucide="map-pin"></i> Miami, FL</p>
          <p><i data-lucide="star"></i> 4.9 / 5.0</p>
          <button onclick="window.location.href='{{route('hotels.show', ['hotel' => 16, 'back' => url()->current()])}}'" class="view-btn"><i data-lucide="eye"></i> View Details</button>
          <button class="remove-btn"><i data-lucide="heart-off"></i> Remove</button>
        </div>
      </div>

      <div class="favorite-card">
        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&h=600&fit=crop&crop=center" alt="Mountain Lodge">
        <div class="favorite-info">
          <h3>Mountain Lodge</h3>
          <p><i data-lucide="map-pin"></i> Aspen, CO</p>
          <p><i data-lucide="star"></i> 4.7 / 5.0</p>
          <button onclick="window.location.href='{{route('hotels.show', ['hotel' => 16, 'back' => url()->current()])}}'" class="view-btn"><i data-lucide="eye"></i> View Details</button>
          <button class="remove-btn"><i data-lucide="heart-off"></i> Remove</button>
        </div>
      </div>
      <div class="favorite-card">
        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&h=600&fit=crop&crop=center" alt="Grand Plaza Hotel">
        <div class="favorite-info">
          <h3>Grand Plaza Hotel</h3>
          <p><i data-lucide="map-pin"></i> New York, NY</p>
          <p><i data-lucide="star"></i> 4.8 / 5.0</p>
          <button onclick="window.location.href='{{route('hotels.show', ['hotel' => 16, 'back' => url()->current()])}}'" class="view-btn"><i data-lucide="eye"></i> View Details</button>
          <button class="remove-btn"><i data-lucide="heart-off"></i> Remove</button>
        </div>
      </div>

      <div class="favorite-card">
        <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&h=600&fit=crop&crop=center" alt="Ocean View Resort">
        <div class="favorite-info">
          <h3>Ocean View Resort</h3>
          <p><i data-lucide="map-pin"></i> Miami, FL</p>
          <p><i data-lucide="star"></i> 4.9 / 5.0</p>
          <button onclick="window.location.href='{{route('hotels.show', ['hotel' => 16, 'back' => url()->current()])}}'" class="view-btn"><i data-lucide="eye"></i> View Details</button>
          <button class="remove-btn"><i data-lucide="heart-off"></i> Remove</button>
        </div>
      </div>

      <div class="favorite-card">
        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&h=600&fit=crop&crop=center" alt="Mountain Lodge">
        <div class="favorite-info">
          <h3>Mountain Lodge</h3>
          <p><i data-lucide="map-pin"></i> Aspen, CO</p>
          <p><i data-lucide="star"></i> 4.7 / 5.0</p>
          <button onclick="window.location.href='{{route('hotels.show', ['hotel' => 16, 'back' => url()->current()])}}'" class="view-btn"><i data-lucide="eye"></i> View Details</button>
          <button class="remove-btn"><i data-lucide="heart-off"></i> Remove</button>
        </div>
      </div>
      <div class="favorite-card">
        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&h=600&fit=crop&crop=center" alt="Grand Plaza Hotel">
        <div class="favorite-info">
          <h3>Grand Plaza Hotel</h3>
          <p><i data-lucide="map-pin"></i> New York, NY</p>
          <p><i data-lucide="star"></i> 4.8 / 5.0</p>
          <button onclick="window.location.href='{{route('hotels.show', ['hotel' => 16, 'back' => url()->current()])}}'" class="view-btn"><i data-lucide="eye"></i> View Details</button>
          <button class="remove-btn"><i data-lucide="heart-off"></i> Remove</button>
        </div>
      </div>

      <div class="favorite-card">
        <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&h=600&fit=crop&crop=center" alt="Ocean View Resort">
        <div class="favorite-info">
          <h3>Ocean View Resort</h3>
          <p><i data-lucide="map-pin"></i> Miami, FL</p>
          <p><i data-lucide="star"></i> 4.9 / 5.0</p>
          <button onclick="window.location.href='{{route('hotels.show', ['hotel' => 16, 'back' => url()->current()])}}'" class="view-btn"><i data-lucide="eye"></i> View Details</button>
          <button class="remove-btn"><i data-lucide="heart-off"></i> Remove</button>
        </div>
      </div>

      <div class="favorite-card">
        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&h=600&fit=crop&crop=center" alt="Mountain Lodge">
        <div class="favorite-info">
          <h3>Mountain Lodge</h3>
          <p><i data-lucide="map-pin"></i> Aspen, CO</p>
          <p><i data-lucide="star"></i> 4.7 / 5.0</p>
          <button onclick="window.location.href='{{route('hotels.show', ['hotel' => 16, 'back' => url()->current()])}}'" class="view-btn"><i data-lucide="eye"></i> View Details</button>
          <button class="remove-btn"><i data-lucide="heart-off"></i> Remove</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    lucide.createIcons();
  </script>
@endsection

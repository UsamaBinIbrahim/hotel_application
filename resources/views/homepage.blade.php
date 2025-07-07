@extends('layouts.app')

@section('title')
  Hotel Booking | Home
@endsection

@section('style')
  <link rel="stylesheet" href="{{asset('styles/homepage.css')}}">
@endsection  

@section('content')
  <section class="hero-section">
    <div class="hero-background" style="background-image: url('{{ asset('/images/hotel_pool.jpg') }}');"></div>
    <div class="hero-content">
      <h1>
        Discover Top-Rated Hotels
        <span>at the Best Prices</span>
      </h1>
      <p>
        Find your perfect stay with verified reviews, secure booking, and unbeatable deals
      </p>
    </div>

    <div class="hero-fade"></div>
  </section>

<section class="hotel-grid-section">
  <div class="section-header">
    <h2>Featured Hotels</h2>
    <p>Handpicked accommodations offering exceptional comfort and value</p>
  </div>

  <div class="hotel-grid">
    @foreach ($top_hotels as $hotel)
      {{-- HotelCard Blade --}}
      <a href="{{ route('hotels.show', ['hotel' => $hotel->id, 'back' => url()->current()]) }}" class="hotel-card">
        {{-- DO NOT MODIFY this loop's contents --}}
        <div class="hotel-image-wrapper">
          <img src="{{ asset('storage/' . $hotel->main_image) }}" alt="{{ $hotel->name }}">
          <div class="hotel-rating-badge">
            <i data-lucide="star" class="star-icon"></i>
            <span>{{ $hotel->rating }}</span>
          </div>
        </div>

        <div class="hotel-content">
          <h3>{{ $hotel->name }}</h3>
          <div class="hotel-location">
            <i data-lucide="map-pin" class="location-icon"></i>
            <span>{{ $hotel->location }}</span>
          </div>

          <div class="hotel-bottom">
            <div class="hotel-price">
              ${{ $hotel->price_per_night }}
              <span>/night</span>
            </div>
          </div>
        </div>
      </a>
    @endforeach
  </div>

  <div class="show-all-container">
    <button class="show-all-button">
      Show All Hotels
      <span class="arrow">→</span>
    </button>
  </div>
</section>

  
<section class="features-section">
  <div class="container">
    <div class="text-center section-header">
      <h2>Why Choose Our Platform?</h2>
      <p>We make hotel booking simple, secure, and reliable for travelers worldwide</p>
    </div>

    <div class="features-grid">
      <div class="feature-card">
        <div class="icon-box">
          <i data-lucide="calendar"></i>
        </div>
        <h3>Easy Booking</h3>
        <p>Book hotels in just a few clicks with real-time availability and instant confirmation.</p>
      </div>

      <div class="feature-card">
        <div class="icon-box">
          <i data-lucide="shield"></i>
        </div>
        <h3>Secure Payments</h3>
        <p>All transactions are encrypted and handled safely with our trusted payment partners.</p>
      </div>

      <div class="feature-card">
        <div class="icon-box">
          <i data-lucide="users"></i>
        </div>
        <h3>Verified Reviews</h3>
        <p>Read genuine reviews from other travelers before making your booking decision.</p>
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      @if(session('account_delete') === 'success')
        alertSuccess({title: 'Account Deleted', text: 'Account has deleted successfully'});
      @endif

      lucide.createIcons();
    })
  </script>
@endsection
@extends('layouts.app')

@section('title')
  Hotel Booking | Profile
@endsection

@section('style')  
    <link rel="stylesheet" href="{{asset('styles/profile/index.css')}}" />
@endsection  

@section('content')
  <div class="main-container">
    <div class="logout-bar">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">
          <i data-lucide="log-out"></i> Logout
        </button>
      </form>
    </div>
    
    <!-- Header -->
    <div class="header">
      <h1>Welcome back, John! 👋</h1>
      <p>Manage your bookings, update your profile, and discover your favorite destinations</p>
    </div>

    <!-- Grid Sections -->
    <div class="grid">
      <!-- Bookings -->
      <div class="card">
        <div class="card-header blue">
          <div class="icon-box" data-lucide="calendar"></div>
          Your Bookings
        </div>
        <div class="card-content">
          <div class="booking-summary">
            <div>
              <div class="big blue">3</div>
              <div class="blue">Active Bookings</div>
            </div>
            <div class="icon-circle">
              <i data-lucide="calendar"></i>
            </div>
          </div>
          <div class="booking-stats">
            <div class="stat-box">
              <div class="big blue">2</div>
              <div class="blue">Upcoming</div>
            </div>
            <div class="stat-box">
              <div class="big green">1</div>
              <div class="green">In Progress</div>
            </div>
          </div>
          <a href="{{route('bookings.index')}}" class="button blue full"><i data-lucide="eye"></i>View All Bookings</a>
        </div>
      </div>

      <!-- Profile -->
      <div class="card">
        <div class="card-header green">
          <div class="icon-box" data-lucide="user"></div>
          Profile Information
        </div>
        <div class="card-content">
          <div class="profile-head">
            <div class="avatar">JD</div>
          </div>
          <div class="info-block">
            <p>Email Address</p>
            <strong>john@example.com</strong>
          </div>
          <div class="info-block">
            <p>Member Since</p>
            <strong>January 2024</strong>
          </div>
          <a href="{{route('profile.edit')}}" class="button green outline full"><i data-lucide="edit"></i>Edit Profile</a>
          <a href="#" class="button gray outline full"><i data-lucide="lock"></i>Change Password</a>
        </div>
      </div>

      <!-- Favorites -->
      <div class="card favorites">
        <div class="card-header red">
          <div class="icon-box" data-lucide="heart"></div>
          Favorite Hotels
        </div>
        <div class="card-content">
          <div class="hotel">
            <img src="https://images.unsplash.com/photo-1564501049412-61c2a3083791?w=80&h=80&fit=crop&crop=center" alt="Hotel" />
            <div>
              <p>Grand Plaza Hotel</p>
              <span><i data-lucide="map-pin"></i> New York, NY</span>
              <span><i data-lucide="star"></i> 4.8</span>
            </div>
          </div>
          <div class="hotel">
            <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=80&h=80&fit=crop&crop=center" alt="Hotel" />
            <div>
              <p>Ocean View Resort</p>
              <span><i data-lucide="map-pin"></i> Miami, FL</span>
              <span><i data-lucide="star"></i> 4.9</span>
            </div>
          </div>
          <div class="hotel">
            <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=80&h=80&fit=crop&crop=center" alt="Hotel" />
            <div>
              <p>Mountain Lodge</p>
              <span><i data-lucide="map-pin"></i> Aspen, CO</span>
              <span><i data-lucide="star"></i> 4.7</span>
            </div>
          </div>
          <div class="shown">3 of 12 favorites shown</div>
          <a href="{{route('favorites.index')}}" class="button red outline full"><i data-lucide="heart"></i>View All Favorites</a>
        </div>
      </div>
    </div>

    <!-- Stats -->
    <div class="stats">
      <div class="stat blue">
        <div class="circle"><i data-lucide="calendar"></i></div>
        <strong>127</strong>
        <p>Total Bookings</p>
      </div>
      <div class="stat red">
        <div class="circle"><i data-lucide="heart"></i></div>
        <strong>12</strong>
        <p>Favorite Hotels</p>
      </div>
    </div>
  </div>

  <script>
    lucide.createIcons();
  </script>
@endsection
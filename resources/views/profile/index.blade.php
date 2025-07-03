@extends('layouts.app')

@section('title')
  Hotel Booking | Profile
@endsection

@section('style')  
    <link rel="stylesheet" href="{{asset('styles/profile/index.css')}}" />
@endsection  

@php
  $user = auth()->user();
@endphp

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
      <h1>Welcome back, {{$user->name}}! 👋</h1>
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
              <div class="big blue">{{$user->bookings()->where('status', 'active')->count()}}</div>
              <div class="blue">Active Bookings</div>
            </div>
            <div class="icon-circle">
              <i data-lucide="calendar"></i>
            </div>
          </div>
          <div class="booking-stats">
            <div class="stat-box">
              <div class="big amber">{{$user->bookings()->where('status', 'upcoming')->count()}}</div>
              <div class="amber">Upcoming</div>
            </div>
            <div class="stat-box">
              <div class="big green">{{$user->bookings()->where('status', 'completed')->count()}}</div>
              <div class="green">Completed</div>
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
            <div class="avatar">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($user->name, 0, 2)) }}</div>
          </div>
          <div class="info-block">
            <p>Email Address</p>
            <strong>{{$user->email}}</strong>
          </div>
          <div class="info-block">
            <p>Member Since</p>
            <strong>{{$user->created_at->toDateString()}}</strong>
          </div>
          <a href="{{route('profile.edit')}}" class="button green outline full"><i data-lucide="edit"></i>Edit Profile</a>
          <a href="#" class="button gray outline full"><i data-lucide="lock"></i>Change Password</a>
        </div>
      </div>

      <!-- Favorites -->
      @php
          $favorite_hotels = $user->favoriteHotels;
      @endphp
      <div class="card favorites">
        <div class="card-header red">
          <div class="icon-box" data-lucide="heart"></div>
          Favorite Hotels
        </div>
        <div class="card-content">
          @if ($user->favoriteHotels->isEmpty())
            <div class="empty-state">
              <i data-lucide="heart-off" class="empty-icon"></i>
              <p>You have no favorite hotels yet.</p>
              <p>Browse and tap the heart icon to add some!</p>
            </div>
          @else
            @foreach ($user->favoriteHotels as $hotel)
              <div class="hotel">
                <img src="{{asset('storage/' . $hotel->main_image)}}" alt="{{$hotel->name}}">
                <div>
                  <p>{{$hotel->name}}</p>
                  <span><i data-lucide="map-pin"></i> {{$hotel->location}}</span>
                  <span><i data-lucide="star"></i> 4.8</span>
                </div>
              </div>
            @endforeach
          @endif
          <a href="{{route('favorites.index')}}" class="button red outline full"><i data-lucide="heart"></i>View All Favorites</a>
        </div>
      </div>
    </div>

    <!-- Stats -->
    <div class="stats">
      <div class="stat blue">
        <div class="circle"><i data-lucide="calendar"></i></div>
        <strong>{{$user->bookings()->count()}}</strong>
        <p>Total Bookings</p>
      </div>
      <div class="stat red">
        <div class="circle"><i data-lucide="heart"></i></div>
        <strong>{{$user->favoriteHotels()->count()}}</strong>
        <p>Favorite Hotels</p>
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
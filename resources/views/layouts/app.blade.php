<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{asset('styles/layouts/app.css')}}">
  @yield('style')
</head>
<body>
  <header>
    <div class="logo">
        <h1>Hotel Booking App</h1>
        <p>Find and book your perfect stay</p>
    </div>
    <nav>
      <a href="{{route('homepage')}}">Home</a>
      <a href="{{route('hotels.index')}}">Browse Hotels</a>
      @if (Auth::check())
        <a href="{{route('profile.index')}}" class="login-btn">Profile</a>
      @else
        <a href="{{route('login')}}" class="login-btn">Login</a>
      @endif
    </nav>
  </header>

  @yield('content')

  <footer>
    <p>&copy; 2023 Our Hotel. All rights reserved.</p>
    <a href="{{route('homepage')}}" class="footer-link">&cir; Home</a>
    <a href="{{route('hotels.index')}}" class="footer-link">&cir; Browse Hotels</a>
    <a href="login.html" class="footer-link">&cir; Login</a>
  </footer>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hotel Booking | Home</title>
  <link rel="stylesheet" href="{{asset('/styles/index.css')}}">
</head>
<body>
  <header>
    <div class="logo">
        <h1>Hotel Booking App</h1>
        <p>Find and book your perfect stay</p>
    </div>
    <nav>
      <a href="{{route('index')}}">Home</a>
      <a href="{{route('hotels.index')}}">Browse Hotels</a>
      <a href="login.html">Login</a>
    </nav>
  </header>

  <div class="hero">
    Discover top-rated hotels at the best prices
  </div>

  <section id="hotels">
    <div class="hotel">
        <div class="hotel-photo"><img src="{{asset('/images/hotel.h')}}" alt=""></div>
        <div class="hotel-description">Standard Double Room</div>
        <div class="hotel-booking-price">$ 60</div>
    </div>
    <div class="hotel">
        <div class="hotel-photo"><img src="{{asset('/images/hotel.h')}}" alt=""></div>
        <div class="hotel-description">Standard Double Room</div>
        <div class="hotel-booking-price">$ 60</div>
    </div>
    <div class="hotel">
        <div class="hotel-photo"><img src="{{asset('/images/hotel.h')}}" alt=""></div>
        <div class="hotel-description">Standard Double Room</div>
        <div class="hotel-booking-price">$ 60</div>
    </div>
    <div id="show-all-hotels" onclick="window.location.href='{{route('hotels.index')}}'">
        Show All Hotels <span>&ThinSpace;&#x2192;</span>
    </div>
  </section>
  
  <section class="features">
    <div class="feature">
      <h3>Easy Booking</h3>
      <p>Book hotels in just a few clicks with real-time availability.</p>
    </div>
    <div class="feature">
      <h3>Secure Payments</h3>
      <p>All transactions are encrypted and handled safely.</p>
    </div>
    <div class="feature">
      <h3>Verified Reviews</h3>
      <p>Read genuine reviews from other travelers before booking.</p>
    </div>
  </section>

  <footer>
    <p>&copy; 2023 Our Hotel. All rights reserved.</p>
    <a href="{{route('index')}}" class="footer-link">&cir; Home</a>
    <a href="{{route('hotels.index')}}" class="footer-link">&cir; Browse Hotels</a>
    <a href="login.html" class="footer-link">&cir; Login</a>
  </footer>
</body>
</html>
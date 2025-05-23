<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hotel Details | Hotel Booking</title>
  <link rel="stylesheet" href="{{asset('/styles/hotel_details.css')}}">
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

  <div class="hotel-container">
    <h2>Sunrise Resort</h2>

    <div class="hotel-details">
      <img src="{{asset('/images/' . $hotel['image'])}}" alt="Hotel Image" />

      <div class="hotel-info">
        <h3>About the Hotel</h3>
        <p><strong>Location:</strong> {{$hotel['location']}} </p>
        <p><strong>Price per Night:</strong> ${{$hotel['price']}}</p>
        <p><strong>Amenities:</strong></p>
        <ul>
            @foreach ($hotel['amenities'] as $amenity)
                <li>{{$amenity}}</li>
            @endforeach
        </ul>
        <p><strong>Description:</strong>{{$hotel['description']}}</p>

        <button class="book-now-btn" onclick="bookNow()">Book Now</button>
      </div>
    </div>

    <h3>Guest Reviews</h3>
    <p><strong>Rating:</strong> 4.5/5</p>
    <p>“A fantastic stay! The staff were wonderful, and the views were incredible.” - John Doe</p>
    <p>“Highly recommend this resort for anyone visiting Beirut. Great amenities!” - Jane Smith</p>
  </div>

  <footer>
    <p>&copy; 2023 Our Hotel. All rights reserved.</p>
    <a href="{{route('index')}}" class="footer-link">&cir; Home</a>
    <a href="{{route('hotels.index')}}" class="footer-link">&cir; Browse Hotels</a>
    <a href="login.html" class="footer-link">&cir; Login</a>
  </footer>

  <script>
    function bookNow() {
      alert("Redirecting to booking page...");
      window.location.href = "booking.html";
    }
  </script>

</body>
</html>
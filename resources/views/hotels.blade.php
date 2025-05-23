<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Browse Hotels | Hotel Booking</title>
  <link rel="stylesheet" href="{{asset('/styles/hotels.css')}}">
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

  <div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search by location or name..." />
    <button onclick="filterHotels()">Search</button>
  </div>

  <div class="hotels-container" id="hotelsContainer">
    @foreach ($hotels as $hotel)
        <div class="hotel-card">
            <img src="{{asset('/images/' . $hotel['image'])}}" alt="{{$hotel['name']}}">
            <div class="hotel-info">
                <h3>{{$hotel['name']}}</h3>
                <p>Location: {{$hotel['location']}}</p>
                <p>Price: {{$hotel['price']}}/night</p>
                <button onclick="window.location.href='{{route('hotels.show')}}'">View Details</button>
            </div>
        </div>
    @endforeach
  </div>

  <footer>
    <p>&copy; 2023 Our Hotel. All rights reserved.</p>
    <a href="{{route('index')}}" class="footer-link">&cir; Home</a>
    <a href="{{route('hotels.index')}}" class="footer-link">&cir; Browse Hotels</a>
    <a href="login.html" class="footer-link">&cir; Login</a>
  </footer>

  <script>
    // const hotels = [
    //   {
    //     name: "Sunrise Resort",
    //     location: "Beirut",
    //     price: 120,
    //     image: "hotel.h"
    //   },
    //   {
    //     name: "Mountain Inn",
    //     location: "Ehden",
    //     price: 90,
    //     image: "hotel.h"
    //   },
    //   {
    //     name: "Beachside Hotel",
    //     location: "Jounieh",
    //     price: 150,
    //     image: "hotel.h"
    //   },
    //   {
    //     name: "Sunrise Resort",
    //     location: "Beirut",
    //     price: 120,
    //     image: "hotel.h"
    //   },
    //   {
    //     name: "Mountain Inn",
    //     location: "Ehden",
    //     price: 90,
    //     image: "hotel.h"
    //   },
    //   {
    //     name: "Beachside Hotel",
    //     location: "Jounieh",
    //     price: 150,
    //     image: "hotel.h"
    //   }
    // ];

    // function renderHotels(hotelList) {
    //   const container = document.getElementById('hotelsContainer');
    //   container.innerHTML = '';
    //   hotelList.forEach(hotel => {
    //     const card = document.createElement('div');
    //     card.className = 'hotel-card';
    //     card.innerHTML = `
    //       <img src="${hotel.image}" alt="${hotel.name}" />
    //       <div class="hotel-info">
    //         <h3>${hotel.name}</h3>
    //         <p>Location: ${hotel.location}</p>
    //         <p>Price: $${hotel.price}/night</p>
    //         <button onclick="viewDetails('${hotel.name}')">View Details</button>
    //       </div>
    //     `;
    //     container.appendChild(card);
    //   });
    // }

    function filterHotels() {
      const query = document.getElementById('searchInput').value.toLowerCase();
      const filtered = hotels.filter(h =>
        h.name.toLowerCase().includes(query) || h.location.toLowerCase().includes(query)
      );
      renderHotels(filtered);
    }

    function viewDetails(hotelName) {
      alert("Redirecting to details for: " + hotelName);
      // Replace with actual redirect logic later
      window.location.href = "hotel-details.html";
    }

    // renderHotels(hotels);
  </script>
</body>
</html>
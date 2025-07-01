@extends('layouts.app')

@section('title')
  Hotel Booking | Browse Hotels
@endsection

@section('style')
  <link rel="stylesheet" href="{{asset('styles/hotels/index.css')}}">
@endsection

@section('content')
  <div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search by location or name..." />
    <button onclick="filterHotels()">Search</button>
  </div>

  <div class="hotels-container" id="hotelsContainer">
    @foreach ($hotels as $hotel)
        <div class="hotel-card">
            <img src="{{asset('images/hotel.h')}}" alt="{{$hotel->name}}">
            <div class="hotel-info">
                <h3>{{$hotel->name}}</h3>
                <p>Location: {{$hotel->location}}</p>
                <p>Price: <span>{{$hotel->price_per_night}}/night</span></p>
                <button onclick="window.location.href='{{route('hotels.show', $hotel->id)}}'">View Details</button>
            </div>
        </div>
    @endforeach
  </div>

  <script>
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

    // renderHotels(hotels);
  </script> 
@endsection
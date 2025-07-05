@extends('layouts.app')

@section('title')
  Hotel Booking | Browse Hotels
@endsection

@section('style')
  <link rel="stylesheet" href="{{ asset('styles/profile/index.css') }}">
  <link rel="stylesheet" href="{{asset('styles/hotels/index.css')}}">
@endsection

@section('content')
  <div class="header">
    <h1>Browse Hotels 🏨</h1>
    <p>Find your next destination and explore top-rated stays around the world</p>
  </div>
  
  <div class="search-bar">
    <input type="text" name="search_input" id="search-input" value="{{$filter}}" placeholder="Search by location or name..." />
    <button id="search-btn"><i data-lucide="search"></i></button>
      <button id="clear-filter-btn" title="Clear Filter" {{$filter && $filter !== '' ? '' : "style=display:none;"}}>
        <i data-lucide="x-circle"></i>
      </button>
  </div>

  <div class="hotels-container" id="hotelsContainer">
    @foreach ($hotels as $hotel)
        <div class="hotel-card">
            <img src="{{asset('storage/' . $hotel->main_image)}}" alt="{{$hotel->name}}">
            <div class="hotel-info">
                <h3>{{$hotel->name}}</h3>
                <p><i data-lucide="map-pin"></i> {{$hotel->location}}</p>
                <p><i data-lucide="circle-dollar-sign"></i> <span>${{$hotel->price_per_night}}/night</span></p>
                <button onclick="viewHotelDetails({{$hotel->id}})">
                  <i data-lucide="eye"></i> View Details
                </button>
            </div>
        </div>
    @endforeach
  </div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      lucide.createIcons();
    });

    $searchBtn = $('#search-btn');
    $searchInput = $('#search-input');
    $clearBtn = $('#clear-filter-btn');

    $searchBtn.on('click', function() {
      $searchBtn.attr('disabled', true);
      const url = '{{route('hotels.filter')}}';
      $.ajax({
        url: url,
        method: 'GET',
        data: {
          filter: $searchInput.val(),
        },
        success: function(response) {
          const filter = $searchInput.val();
          const newUrl = `{{route('hotels.index')}}?filter=${encodeURIComponent(filter)}`;
          window.history.pushState({}, '', newUrl);
          $('.hotels-container').html(response.html);
        },
        error: function(error) {
          console.log(error.message);
        }
      });
      
      if ($searchInput.val().trim()) {
        $clearBtn.show();
      } else {
        $clearBtn.hide();
      }
      $searchBtn.removeAttr('disabled');
    });

    $clearBtn.on('click', function() {
      $searchInput.val('');
      $clearBtn.hide();
      $searchBtn.click();
    });

    function viewHotelDetails(hotelId) {
      const currentUrl = window.location.href;      
      const url = '{{route('hotels.show', ['hotel' => ':hotelId'])}}'.replace(':hotelId', hotelId) 
      + `?back=${encodeURIComponent(currentUrl)}`;
      console.log(`current url: ${currentUrl}\nurl: ${url}`);
      window.location.href = url;
    }
  </script>
@endsection
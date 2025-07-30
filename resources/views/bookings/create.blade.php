@extends('layouts.app')

@section('title')
  Hôtelys | Book Hotel
@endsection

@section('style')
  <link rel="stylesheet" href="{{asset('/styles/bookings/create.css')}}">
  <style>
    body {
      background: url('{{asset('/images/hotel_pool.jpg')}}') no-repeat center center / cover;
    }
  </style>
@endsection

@section('content')
  <div class="booking-container">
    <h2>Reserve Your Stay</h2>
    <form id="booking_form" method="POST" action="{{route('bookings.store', ['hotel' => $hotel->id, 'booking_created' => true])}}">
      @csrf
      <input type="text" placeholder="Full Name" id="full_name" name="full_name" value="{{old('full_name')}}" required />
      <div class="errors">
        <ul>
          @foreach ($errors->get('full_name') as $message)
            <li>{{$message}}</li>
          @endforeach
        </ul>
      </div>
      <input type="email" placeholder="Email" id="email" name="email" value="{{old('email')}}" required />
      <div class="errors">
        <ul>
          @foreach ($errors->get('email') as $message)
            <li>{{$message}}</li>
          @endforeach
        </ul>
      </div>
      <input type="text" placeholder="Phone Number" id="phone_number" name="phone_number" value="{{old('phone_number')}}" required />
      <div class="errors">
        <ul>
          @foreach ($errors->get('phone_number') as $message)
            <li>{{$message}}</li>
          @endforeach
        </ul>
      </div>
      <label for="check_in">Check-in Date:</label>
      <input type="date" id="check_in" name="check_in" class="check-date" value="{{old('check_in')}}" required />
      <div class="errors">
        <ul>
          @foreach ($errors->get('check_in') as $message)
            <li>{{$message}}</li>
          @endforeach
        </ul>
      </div>
      <label for="check_out">Check-out Date:</label>
      <input type="date" id="check_out" name="check_out" class="check-date" value="{{old('check_out')}}" required />
      <div class="errors">
        <ul>
          @foreach ($errors->get('check_out') as $message)
            <li>{{$message}}</li>
          @endforeach
        </ul>
      </div>
      <label for="adults">Number of Adults:</label>
      <input type="number" id="adults" name="adults" class="guests-number" min="1" value="{{old('adults') ?? 1}}" required>
      <div class="errors">
        <ul>
          @foreach ($errors->get('adults') as $message)
            <li>{{$message}}</li>
          @endforeach
        </ul>
      </div>
      <label for="children">Number of Children:</label>
      <input type="number" id="children" name="children" class="guests-number" min="0" value="{{old('children') ?? 0}}">
      <div class="errors">
        <ul>
          @foreach ($errors->get('guests_sum') as $message)
            <li>{{$message}}</li>
          @endforeach
          @foreach ($errors->get('children') as $message)
            <li>{{$message}}</li>
          @endforeach
        </ul>
      </div>
      <button type="submit">Confirm Booking: $<span id="total-cost">{{$hotel->price_per_night}}</span></button>
    </form>
  </div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      const pricePerNight = {{$hotel->price_per_night}};
      const baseGuestCount = {{$hotel->base_guest_count}};
      const extraAdultFee = {{$hotel->extra_adult_fee}};
      const extraChildFee = {{$hotel->extra_child_fee}};

      var nights;

      $('.check-date').on('change', function() {
        const checkInTime = new Date($('#check_in').val()).getTime();
        const checkOutTime = new Date($('#check_out').val()).getTime();
        nights = (checkOutTime - checkInTime) / (1000 * 60 * 60 * 24);
        $('.guests-number').change();
      });
      
      $('.guests-number').on('change', function() {
        const adults = $('#adults').val();
        const children = $('#children').val();
        
        var baseAdults = Math.min(adults, baseGuestCount);
        var baseChildren = Math.min(children, baseGuestCount - baseAdults);
        
        var extraAdults = Math.min(adults - baseAdults);
        var extraChildren = children - baseChildren;
        
        if(isNaN(nights) || nights <= 0) {nights = 1;}
        const totalCost = nights
         * (pricePerNight
          + (extraAdultFee * extraAdults)
          + (extraChildFee * extraChildren)
        );

        $('#total-cost').text(totalCost);
      });

      $('#booking_form').on('submit',async function(e) {
        e.preventDefault();
        const totalCost = $('#total-cost').text();
        const isConfirmed = await alertConfirm({text: `Booking total cost: $${totalCost}.\nPlease confirm booking.`});
        if(isConfirmed) {
          this.submit();
        }
      });
    });

    lucide.createIcons();
  </script>
@endsection
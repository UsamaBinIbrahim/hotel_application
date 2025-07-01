@extends('layouts.app')

@section('title')
  Hotel Booking | Book Hotel
@endsection

@section('style')
  <link rel="stylesheet" href="{{asset('/styles/booking/create.css')}}">
@endsection

@section('content')
  <div class="booking-container">
    <h2>Reserve Your Stay</h2>
    <form id="booking_form" method="POST" action="{{route('booking.store', $hotel->id)}}">
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
      <input type="date" id="check_in" name="check_in" value="{{old('check_in')}}" required />
      <div class="errors">
        <ul>
          @foreach ($errors->get('check_in') as $message)
            <li>{{$message}}</li>
          @endforeach
        </ul>
      </div>
      <label for="check_out">Check-out Date:</label>
      <input type="date" id="check_out" name="check_out" value="{{old('check_out')}}" required />
      <div class="errors">
        <ul>
          @foreach ($errors->get('check_out') as $message)
            <li>{{$message}}</li>
          @endforeach
        </ul>
      </div>
      <label for="adults">Number of Adults:</label>
      <input type="number" id="adults" name="adults" min="1" value="1" required>
      <div class="errors">
        <ul>
          @foreach ($errors->get('adults') as $message)
            <li>{{$message}}</li>
          @endforeach
        </ul>
      </div>
      <label for="children">Number of Children:</label>
      <input type="number" id="children" name="children" min="0" value="0">
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
      <button type="submit">Confirm Booking</button>
    </form>
  </div>

  {{-- <script>
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const name = document.getElementById('fullName').value;
      const email = document.getElementById('email').value;
      const checkIn = document.getElementById('checkIn').value;
      const checkOut = document.getElementById('checkOut').value;
      const guests = document.getElementById('guests').value;

      // Display confirmation message and redirect
      alert(`Booking confirmed for ${name} from ${checkIn} to ${checkOut}.\nGuests: ${guests}\nConfirmation sent to: ${email}`);
      window.location.href = "confirmation.html"; // Redirect to confirmation page after booking
    });
  </script> --}}
@endsection
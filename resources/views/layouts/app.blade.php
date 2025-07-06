<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
      @if (auth()->check())
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
      @if (auth()->check())
        <a href="{{route('profile.index')}}" class="footer-link">&cir; Profile</a>
      @else
      <a href="{{route('login')}}" class="footer-link">&cir; Login</a>
      @endif
  </footer>
  
  <script src="{{asset('scripts/lucide.js')}}"></script>
  {{-- <script src="https://unpkg.com/lucide@0.525.0/dist/umd/lucide.min.js"></script> --}}
  <script src="{{asset('scripts/jquery.js')}}"></script>
  {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}
  <script src="{{asset('scripts/jsdelivr.js')}}"></script>
  {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    function alertSuccess(options) {
      if(!options || typeof options !== 'object') throw new Error('alertSuccess() requires a plain object parameter.');
      if(!options.title) throw new Error('alertSuccess() requires title key of the plain object parameter.');
      if(!options.text) throw new Error('alertSuccess() requires text key of the plain object parameter.');
      Swal.fire({
        icon: 'success',
        title: options.title,
        text: options.text,
        timer: 2000,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
      });
    }

    function alertError() {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Something went wrong!',
        timer: 2500,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
      });
    }

    function alertConfirm(options) {
      if(!options || typeof options !== 'object') throw new Error('alertConfirm() requires a plain object parameter.');
      if(!options.text) throw new Error('alertConfirm() requires text key of the plain object parameter.');
      return Swal.fire({
        icon: 'question',
        title: 'Confirm',
        text: options.text,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        cancelButtonText: 'Cancel'
      }).then(result =>  result.isConfirmed);
    }
  </script>
  @yield('scripts')
</body>
</html>
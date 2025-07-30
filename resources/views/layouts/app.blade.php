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
  <header class="navbar">
    <div class="navbar-container">
      {{-- Logo --}}
      <div class="navbar-logo">
        <i data-lucide="hotel" class="logo-icon"></i>
        <div>
          <h1>Hôtelys App</h1>
          <p>Find and book your perfect stay</p>
        </div>
      </div>

      {{-- Desktop Menu --}}
      <nav class="navbar-links">
        <a href="{{ route('homepage.index') }}">Home</a>
        <a href="{{ route('hotels.index') }}">Browse Hotels</a>
        @if (auth()->check())
          <a href="{{ route('profile.index') }}" class="login-btn">
            <i data-lucide="user" class="icon-inline"></i> Profile
          </a>
        @else
          <a href="{{ route('login') }}" class="login-btn">
            <i data-lucide="log-in" class="icon-inline"></i> Sign In
          </a>
        @endif
      </nav>

      {{-- Mobile Menu Toggle --}}
      <button class="navbar-toggle" id="mobileToggle" aria-label="Toggle menu">
        <span class="icon-holder" data-icon-state="menu">
          <i data-lucide="menu" class="menu-icon"></i>
        </span>
      </button>
    </div>

    {{-- Mobile Menu --}}
    <div class="mobile-menu" id="mobileMenu">
      <a href="{{ route('homepage.index') }}">Home</a>
      <a href="{{ route('hotels.index') }}">Browse Hotels</a>
      @if (auth()->check())
        <a href="{{ route('profile.index') }}" class="login-btn">
          <i data-lucide="user" class="icon-inline"></i> Profile
        </a>
      @else
        <a href="{{ route('login') }}" class="login-btn">
          <i data-lucide="log-in" class="icon-inline"></i> Sign In
        </a>
      @endif
    </div>
  </header>

  @yield('content')
  
  <footer class="site-footer">
    <div class="footer-container">
      <p class="footer-copy">&copy; 2023 Our Hotel. All rights reserved.</p>

      <div class="footer-links">
        <a href="{{ route('homepage.index') }}" class="footer-link">
          <span class="dot">&bull;</span> Home
        </a>
        <a href="{{ route('hotels.index') }}" class="footer-link">
          <span class="dot">&bull;</span> Browse Hotels
        </a>
        @if (auth()->check())
          <a href="{{ route('profile.index') }}" class="footer-link">
            <span class="dot">&bull;</span> Profile
          </a>
        @else
          <a href="{{ route('login') }}" class="footer-link">
            <span class="dot">&bull;</span> Sign In
          </a>
        @endif
      </div>
    </div>
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
        timer: 3500,
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
        timer: 3500,
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

    function alertWarning(options) {
      if(!options || typeof options !== 'object') throw new Error('alertWarning() requires a plain object parameter.');
      if(!options.text) throw new Error('alertWarning() requires text key of the plain object parameter.');
      return Swal.fire({
        icon: 'warning',
        title: 'Warning',
        text: options.text,
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      }).then(result => result.isConfirmed);
    }

  $(function () {
    $('#mobileToggle').on('click', function () {
      const $menu = $('#mobileMenu');
      const isVisible = $menu.css('display') === 'flex';
      const newIcon = isVisible ? 'menu' : 'x';

      // Toggle menu
      $menu.css('display', isVisible ? 'none' : 'flex');

      // Replace icon
      $(this).html(`<i data-lucide="${newIcon}" class="menu-icon"></i>`);
      lucide.createIcons();
    });
  });

  </script>
  @yield('scripts')
</body>
</html>
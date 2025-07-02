@extends('layouts.app')

@section('title')
  Edit Profile
@endsection

@section('style')
  <link rel="stylesheet" href="{{ asset('styles/profile/edit.css') }}">
@endsection

@section('content')
<div class="edit-profile-container">
  <div class="edit-header">
    <h1>Edit Your Profile</h1>
    <p>Update your personal information to keep your account up to date.</p>
  </div>

  <form action="#" method="POST" class="edit-form">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="name">Full Name</label>
      <input type="text" name="name" id="name" value="John Doe" required>
    </div>

    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" name="email" id="email" value="john@example.com" required>
    </div>

    {{-- <div class="form-group">
      <label for="phone">Phone Number</label>
      <input type="text" name="phone" id="phone" value="+1 555 123 4567">
    </div>

    <div class="form-group">
      <label for="location">Location</label>
      <input type="text" name="location" id="location" value="New York, USA">
    </div> --}}

    <div class="form-actions">
      <a href="{{ route('profile.index') }}" class="button gray outline">
        <i data-lucide="arrow-left"></i> Cancel
      </a>
      <button type="submit" class="button green">
        <i data-lucide="save"></i> Save Changes
      </button>
    </div>
  </form>
</div>

<script>
  lucide.createIcons();
</script>
@endsection

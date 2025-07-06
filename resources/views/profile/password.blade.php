@extends('layouts.app')

@section('title')
  Hotel Booking | Change Password
@endsection

@section('style')
  <link rel="stylesheet" href="{{ asset('styles/profile/edit.css') }}">
@endsection

@section('content')
<div class="edit-profile-container">
  <div class="edit-header">
    <h1>Update Your Password</h1>
    <p>Keep your account secure by regularly updating your password.</p>
  </div>

  <form method="POST" action="{{ route('user-password.update') }}" class="edit-form">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="current_password">Current Password</label>
      <input type="password" name="current_password" id="current_password" required>
    </div>

    @error('current_password', 'updatePassword')
			<div class="alert-error">{{ $message }}</div>
    @enderror

    <div class="form-group">
      <label for="password">New Password</label>
      <input type="password" name="password" id="password" required>
    </div>

    @error('password', 'updatePassword')
			<div class="alert-error">{{ $message }}</div>
    @enderror

    <div class="form-group">
      <label for="password_confirmation">Confirm New Password</label>
      <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div>

    @error('password_confirmation', 'updatePassword')
			<div class="alert-error">{{ $message }}</div>
    @enderror

    <div class="form-actions">
      <a href="{{ route('profile.index') }}" class="button gray outline">
        <i data-lucide="arrow-left"></i> Cancel
      </a>
      <button type="submit" class="button green">
        <i data-lucide="lock"></i> Update Password
      </button>
    </div>
  </form>
</div>
@endsection

@section('scripts')
	<script>
		$(document).ready(function() {
			lucide.createIcons();

			@if(session('status') === 'password-updated')
				alertSuccess({title: 'Password Updated', text: 'Password has been updated successfully.'});
			@endif
		});
	</script>
@endsection
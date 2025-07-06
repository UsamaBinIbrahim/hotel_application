@extends('layouts.app')

@section('title')
  Hotel Booking | Edit Profile
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

  <div class="edit-form">
    <div class="form-group">
      <label for="name">Full Name</label>
      <input type="text" name="name" id="name" value="{{$user->name}}" required>
    </div>

    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" name="email" id="email" value="{{$user->email}}" required>
    </div>

    <div class="form-actions">
      <a href="{{ route('profile.index') }}" class="button gray outline">
        <i data-lucide="arrow-left"></i> Cancel
      </a>
      <button type="button" class="button green" id="save-btn">
        <i data-lucide="save"></i> Save Changes
      </button>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      lucide.createIcons();
    });

    $('#save-btn').on('click', function() {
      $(this).attr('disabled', true);
      const url = '{{route('profile.update')}}';
      $.ajax({
        url: url,
        method: 'PATCH',
        data: {
          name: $('#name').val(),
          email: $('#email').val()
        },
        success: function(response) {
          if(response.status === 'success') {
            alertSuccess({title: 'Profile updated!', text: 'Your profile has been updated successfully.'});
          }
        },
        error: function(error) {
          alertError();
        }
      });
      $(this).removeAttr('disabled');
    });
  </script>
@endsection
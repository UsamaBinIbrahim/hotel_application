@extends('layouts.auth')

@section('title')
    Register
@endsection

@section('heading')
    Register
@endsection

@section('form')
    <form method="POST" action="{{route('register.submit')}}">
        @csrf
        <input type="text" id="name" name="name" value="{{old('name')}}" placeholder="Name" required />
        <div class="errors">
            <ul>
                @foreach ($errors->get('name') as $message)
                <li>{{$message}}</li>
                @endforeach
            </ul>
        </div>
        <input type="email" id="email" name="email" value="{{old('email')}}" placeholder="Email" autocomplete="email" required />
        <div class="errors">
            <ul>
                @foreach ($errors->get('email') as $message)
                <li>{{$message}}</li>
                @endforeach
            </ul>
        </div>
        <input type="password" id="password" name="password" placeholder="Password" autocomplete="current-password" required />
        <div class="errors">
            <ul>
                @foreach ($errors->get('password') as $message)
                <li>{{$message}}</li>
                @endforeach
            </ul>
        </div>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" autocomplete="current-password" required />
        <button type="submit">Register</button>
        <div class="link">
            <p>Already have an account? <a href="{{route('login')}}">Login</a></p>
        </div>
    </form>
@endsection
@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('heading')
    Login
@endsection

@section('form')
    <form method="POST" action="{{route('login.submit')}}">
        @csrf
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
        <div class="remember-me">
            <input type="checkbox" name="remember"> Remember Me
        </div>
        <div class="errors">
            <ul>
                @foreach ($errors->get('login') as $message)
                <li>{{$message}}</li>
                @endforeach
            </ul>
        </div>
        <button type="submit">Login</button>
        <div class="link">
            <p>Don't have an account? <a href="{{route('register')}}">Register</a></p>
        </div>
    </form>
@endsection
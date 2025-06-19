<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('/styles/auth/login.css')}}">
</head>

<body>
  <div class="container">
    <h2>Login</h2>
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
            <p>Don't have an account? <a href="">Register</a></p>
        </div>
    </form>
  </div>
</body>

</html>
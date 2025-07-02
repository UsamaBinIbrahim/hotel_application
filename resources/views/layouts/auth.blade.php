<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') </title>
    <link rel="stylesheet" href="{{asset('/styles/layouts/auth.css')}}">
</head>

<body>
  <div class="container">
    <h2> @yield('heading') </h2>
    @yield('form')
  </div>
</body>

</html>
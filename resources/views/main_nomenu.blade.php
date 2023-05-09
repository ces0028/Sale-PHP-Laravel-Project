<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>판매관리</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('my/css/my.css')}}"></link>
    <script src="https://kit.fontawesome.com/9dc02b3074.js" crossorigin="anonymous"></script>
    
    <script src="{{asset('my/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{asset('my/js/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('my/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('my/js/bootstrap5-datetimepicker.min.js')}}"></script>
    <link href="{{asset('my/css/bootstrap5-datetimepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('my/css/all.min.css')}}" rel="stylesheet">
  </head>
  <body>
    <div class="container">

      @yield("content")

    </div>
  </body>
</html>
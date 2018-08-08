<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hoa Lua</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
</head>
<body id="app-layout">
@yield('content')
<!-- JavaScripts -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>

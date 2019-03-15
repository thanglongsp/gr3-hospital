<!doctype html>
<html lang="en">
<head>
	<link rel="icon" type="image/png" href="{{asset('images/logo.png')}}"/>
    <title>Hospital</title
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/jquery.js')}}"></script> 
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/jquery.dm-uploader.min.js')}}"></script>
</head>
<body> 
    @yield('content')
<!-- @include('layouts.footer') -->
</body>
</html>
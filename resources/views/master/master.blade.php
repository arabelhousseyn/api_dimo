<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/select2.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
</body>
<script src="{{ asset('public/js/app.js') }}"></script>
<script src="{{ asset('public/js/select2.min.js') }}"></script>
<script></script>
</html>
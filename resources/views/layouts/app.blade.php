<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Application')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="topnav" id="topnav">
    <button id="openbtn" class="openbtn">☰</button>
    <a href="{{ url('/') }}" class="logo"><img src="{{ asset('images/logo.png') }}" alt="Logo" height="40"></a>
</div>

<div id="mySidebar" class="sidebar">
    @foreach($navItems as $navItem)
        <a href="{{ url($navItem['url']) }}"><i class="{{ $navItem['icon'] }}"></i> {{ $navItem['name'] }}</a>
    @endforeach
</div>

<div id="main" class="main">
    @yield('content')
</div>

<script src="{{ asset('js/sidebar.js') }}"></script>
@yield('scripts')

</body>
</html>

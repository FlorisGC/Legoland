<!DOCTYPE html>
<html>
<head>
    <title>Legoland Doetinchem</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header>
        <div class="header-container">
            <a href="{{ route('welcome') }}">
                <img class="logo" src="{{ asset('assets/LEGOLAND_PARKS_LOGO.svg') }}" alt="LegoLand Parks Logo">
            </a>
            <div class="header-items">
                <h3><a href="{{ route('attractions') }}" class="{{ Route::currentRouteName() == 'attractions' ? 'active' : '' }}">Attractions</a></h3>
                <h3><a href="{{ route('opening-hours') }}" class="{{ Route::currentRouteName() == 'opening-hours' ? 'active' : '' }}">Opening Hours</a></h3>
                <h3><a href="{{ route('ticket-prices') }}" class="{{ Route::currentRouteName() == 'ticket-prices' ? 'active' : '' }}">Ticket Prices</a></h3>
                <h3><a href="{{ route('contact') }}" class="{{ Route::currentRouteName() == 'contact' ? 'active' : '' }}">Contact</a></h3>
                <h3><a href="{{ route('accommodations') }}" class="{{ Route::currentRouteName() == 'accommodations' ? 'active' : '' }}">Accommodations</a></h3>
                @if(Auth::check())
                    <h3><a href="{{ route('dashboard') }}" class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">Dashboard</a></h3>
                @else
                    <h3><a href="{{ route('login') }}" class="{{ Route::currentRouteName() == 'login' ? 'active' : '' }}">Login</a></h3>
                @endif
            </div>
        </div>
    </header>
    @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

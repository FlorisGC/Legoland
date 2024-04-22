<!DOCTYPE html>
<html>

<head>
    <title>Legoland Doetinchem</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <header>
        <div class="header-container">
            <a href="{{ route('welcome') }}">
                <img class="logo" src="{{ asset('assets/LEGOLAND_PARKS_LOGO.svg') }}" alt="LegoLand Parks Logo">
            </a>
            <div class="header-items">
                <h3><a href="{{ route('attractions') }}"
                        class="{{ Route::currentRouteName() == 'attractions' ? 'active' : '' }}">Attractions</a></h3>
                <h3><a href="{{ route('opening-hours') }}"
                        class="{{ Route::currentRouteName() == 'opening-hours' ? 'active' : '' }}">Opening Hours</a>
                </h3>
                <h3><a href="{{ route('ticket-prices') }}"
                        class="{{ Route::currentRouteName() == 'ticket-prices' ? 'active' : '' }}">Ticket Prices</a>
                </h3>
                <h3><a href="{{ route('contact') }}"
                        class="{{ Route::currentRouteName() == 'contact' ? 'active' : '' }}">Contact</a></h3>
                <h3><a href="{{ route('accommodations') }}"
                        class="{{ Route::currentRouteName() == 'accommodations' ? 'active' : '' }}">Accommodations</a></h3>
            </div>
            <div></div>
        </div>
    </header>
    @yield('content')
</body>

</html>
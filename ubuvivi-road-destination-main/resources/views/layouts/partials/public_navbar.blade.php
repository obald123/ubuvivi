@php
    $servicesActive = request()->is('our-services*')
        || request()->is('tours*')
        || request()->is('cars*')
        || request()->is('services*')
        || request()->is('events*')
        || request()->is('air-ticketing*')
        || request()->is('hotel-booking*')
        || request()->is('hotels*')
        || request()->is('flights*')
        || request()->is('tours-booking*');

    $accountRoute = route('login');
    if (auth()->check()) {
        $accountRoute = auth()->user()->role === 'admin'
            ? route('home')
            : route('client.dashboard');
    }
@endphp

<nav class="ubu-navbar navbar navbar-expand-lg" id="mainNavbar">
    <a class="navbar-brand" href="{{ route('guest.home') }}">
        <img src="{{ asset('assets/images/logo.png?v=1') }}" alt="Ubuvivi Tours">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="hbg-bar"></span>
        <span class="hbg-bar"></span>
        <span class="hbg-bar"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navMenu">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('guest.home') ? 'active-link' : '' }}" href="{{ route('guest.home') }}">
                    <i class="fas fa-home" style="width:18px;opacity:.7"></i> Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $servicesActive ? 'active-link' : '' }}" href="{{ route('guest.all_services') }}">
                    <i class="fas fa-concierge-bell" style="width:18px;opacity:.7"></i> Our Service
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('hotels*') ? 'active-link' : '' }}" href="{{ route('guest.hotels.search') }}">
                    <i class="fas fa-hotel" style="width:18px;opacity:.7"></i> Hotels
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('flights*') ? 'active-link' : '' }}" href="{{ route('guest.flights.search') }}">
                    <i class="fas fa-plane" style="width:18px;opacity:.7"></i> Flights
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('blog.*') ? 'active-link' : '' }}" href="{{ route('blog.index') }}">
                    <i class="fas fa-newspaper" style="width:18px;opacity:.7"></i> Blog
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('guest.contact') ? 'active-link' : '' }}" href="{{ route('guest.contact') }}">
                    <i class="fas fa-envelope" style="width:18px;opacity:.7"></i> Contact
                </a>
            </li>
            <li class="nav-item">
                @auth
                    <a class="nav-link dropdown-toggle {{ request()->is('client/*') || request()->is('home') ? 'active-link' : '' }}" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle" style="width:18px;opacity:.7"></i> My Account
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
                        <a class="dropdown-item" href="{{ $accountRoute }}">Dashboard</a>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('public-logout-form').submit();">
                            Logout
                        </a>
                    </div>
                    <form id="public-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <a class="nav-link {{ request()->is('login*') || request()->is('register*') || request()->is('forgot-password*') || request()->is('reset-password*') ? 'active-link' : '' }}" href="{{ route('login') }}">
                        <i class="fas fa-user" style="width:18px;opacity:.7"></i> My Account
                    </a>
                @endauth
            </li>
        </ul>

        {{-- Plan Your Trip button visible only in mobile menu --}}
        <a href="{{ route('guest.all_services') }}?plan=1" class="plan-trip-mobile d-lg-none mt-2">
            <i class="fas fa-route" style="margin-right:8px"></i>Plan Your Trip
        </a>
    </div>

    <a href="{{ route('guest.all_services') }}?plan=1" class="plan-trip-btn ml-lg-3 d-none d-lg-inline-flex">Plan Your Trip</a>

    <script>
    // Close mobile menu when a nav link is clicked
    document.addEventListener('DOMContentLoaded', function() {
        var toggler = document.querySelector('.ubu-navbar .navbar-toggler');
        var menu    = document.getElementById('navMenu');
        if (!menu || !toggler) return;
        menu.querySelectorAll('.nav-link:not(.dropdown-toggle), .plan-trip-mobile').forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth < 992 && menu.classList.contains('show')) {
                    toggler.click();
                }
            });
        });
    });
    </script>
</nav>

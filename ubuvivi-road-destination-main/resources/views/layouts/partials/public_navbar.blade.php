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
        <img src="{{ asset('assets/images/logos.jpg?v=2') }}" alt="Ubuvivi Tours">
    </a>

    {{-- Hamburger — Bootstrap hides this at lg+ automatically --}}
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="hbg-bar"></span>
        <span class="hbg-bar"></span>
        <span class="hbg-bar"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navMenu">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('guest.home') ? 'active-link' : '' }}" href="{{ route('guest.home') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $servicesActive ? 'active-link' : '' }}" href="{{ route('guest.all_services') }}">Our Service</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('blog.*') ? 'active-link' : '' }}" href="{{ route('blog.index') }}">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('guest.contact') ? 'active-link' : '' }}" href="{{ route('guest.contact') }}">Contact</a>
            </li>
            <li class="nav-item">
                @auth
                    <a class="nav-link dropdown-toggle {{ request()->is('client/*') || request()->is('home') ? 'active-link' : '' }}" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        My Account
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
                        <a class="dropdown-item" href="{{ $accountRoute }}">Dashboard</a>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('public-logout-form').submit();">Logout</a>
                    </div>
                    <form id="public-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                @else
                    <a class="nav-link {{ request()->is('login*') || request()->is('register*') || request()->is('forgot-password*') || request()->is('reset-password*') ? 'active-link' : '' }}" href="{{ route('login') }}">My Account</a>
                @endauth
            </li>
        </ul>

        {{-- Plan Your Trip — only visible inside mobile menu --}}
        <a href="{{ route('guest.all_services') }}?plan=1" class="plan-trip-mobile d-lg-none mt-2">Plan Your Trip</a>
    </div>

    {{-- Plan Your Trip — only visible on desktop --}}
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

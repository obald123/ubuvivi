@php
    $sidebarItems = [
        [
            'label' => 'Dashboard',
            'route' => route('home'),
            'icon' => 'fas fa-th-large',
            'patterns' => ['home*'],
        ],
        [
            'label' => 'Requests',
            'route' => route('requests.index'),
            'icon' => 'fas fa-inbox',
            'patterns' => ['requests*'],
        ],
        [
            'label' => 'Bookings',
            'route' => route('bookings.index'),
            'icon' => 'far fa-calendar-alt',
            'patterns' => ['bookings*'],
        ],
        [
            'label' => 'Services',
            'route' => route('services.index'),
            'icon' => 'fas fa-concierge-bell',
            'patterns' => ['services*', 'vehicles*', 'itineraries*', 'types*', 'packages*'],
        ],
        [
            'label' => 'Blog',
            'route' => route('blog.admin.index'),
            'icon' => 'fas fa-newspaper',
            'patterns' => ['admin/blog*'],
        ],
        [
            'label' => 'Hotels',
            'route' => route('admin.hotels.index'),
            'icon' => 'fas fa-hotel',
            'patterns' => ['admin/hotels*'],
        ],
        [
            'label' => 'Newsletter',
            'route' => route('admin.subscribers.index'),
            'icon' => 'fas fa-envelope-open-text',
            'patterns' => ['admin/subscribers*'],
        ],
        [
            'label' => 'Profile',
            'route' => route('profile.index'),
            'icon' => 'fas fa-user',
            'patterns' => ['profile*', 'users*'],
        ],
    ];
@endphp

<aside id="sidebar-wrapper" class="bg-dark">
    <div class="sidebar-brand">
        <a href="{{ route('home') }}" class="admin-sidebar-brand-link">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Ubuvivi Tours" class="admin-sidebar-logo">
            <span class="admin-sidebar-brand-text">UBUVIVI Tours</span>
        </a>
    </div>
    <ul class="sidebar-menu">
        @foreach($sidebarItems as $item)
            <li class="side-menus {{ request()->is(...$item['patterns']) ? 'active' : '' }}">
                <a class="nav-link" href="{{ $item['route'] }}">
                    <i class="{{ $item['icon'] }}"></i>
                    <span>{{ $item['label'] }}</span>
                </a>
            </li>
        @endforeach

        <li class="side-menus logout-item">
            <form class="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link logout-button">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>
</aside>

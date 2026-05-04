<aside id="sidebar-wrapper" class="bg-dark">
    <div class="sidebar-brand">
        <div class="d-flex align-items-center">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Ubuvivi Tours"
                 style="width:42px;height:42px;border-radius:50%;object-fit:cover;margin-right:12px;border:2px solid rgba(255,255,255,.2);">
            <span class="brand-text">UBUVIVI Tours</span>
        </div>
    </div>
    <ul class="sidebar-menu">
        <li class="side-menus {{ Request::is('home*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        <li class="side-menus {{ Request::is('requests*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('requests.index') }}">
                <i class="fas fa-file-alt"></i>
                <span>Requests</span>
            </a>
        </li>
        
        <li class="side-menus {{ Request::is('bookings*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bookings.index') }}">
                <i class="fas fa-calendar-alt"></i>
                <span>Bookings</span>
            </a>
        </li>
        
        <li class="side-menus {{ Request::is('services*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('services.index') }}">
                <i class="fas fa-cog"></i>
                <span>Services</span>
            </a>
        </li>
        
        <li class="side-menus {{ Request::is('profile*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('profile.index') }}">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
        </li>
        
        <li class="side-menus logout-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</aside>

<aside id="sidebar-wrapper" class="bg-dark">
    <div class="sidebar-brand">
        <img class="navbar-brand-full app-header-logo h-100" src="{{ asset('assets/images/logo.png?v=1') }}"
            alt="Ubuvivi Logo">
        <a href="{{ url('/') }}"></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}" class="small-sidebar-text">
            <img class="navbar-brand-full h-100" src="{{ asset('assets/images/logo.png?v=1') }}" alt="" />
        </a>
    </div>
    <ul class="sidebar-menu mt-5">
        @include('layouts.menu')
    </ul>
</aside>

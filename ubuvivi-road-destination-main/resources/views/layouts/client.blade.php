<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - UBUVIVI Tours</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #f0f2f8; color: #1a1a2e; overflow-x: hidden; }
        a, button, [role="button"] { min-height: 44px; }
        td, th, p { overflow-wrap: break-word; word-break: break-word; }

        /* ── Layout shell ── */
        .cl-layout { display: flex; min-height: 100vh; }

        /* ── Sidebar ── */
        .cl-sidebar {
            width: 240px; flex-shrink: 0;
            background: #0D1F35;
            position: fixed; top: 0; left: 0;
            height: 100vh; overflow-y: auto;
            display: flex; flex-direction: column;
            z-index: 100;
        }
        .cl-sidebar-brand {
            display: flex; align-items: center; gap: 12px;
            padding: 24px 20px 22px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .cl-sidebar-brand img {
            width: 44px; height: 44px; border-radius: 50%;
            object-fit: cover; border: 2px solid rgba(255,255,255,.2);
        }
        .cl-sidebar-brand span {
            color: #fff; font-size: 16px; font-weight: 700;
        }

        /* Nav */
        .cl-nav { flex: 1; padding: 20px 12px; }
        .cl-nav-item {
            display: flex; align-items: center; gap: 12px;
            padding: 11px 14px; border-radius: 10px;
            color: rgba(255,255,255,.6); text-decoration: none;
            font-size: 14px; font-weight: 500;
            margin-bottom: 4px;
            transition: background .2s, color .2s;
        }
        .cl-nav-item i { width: 18px; text-align: center; font-size: 15px; }
        .cl-nav-item:hover { color: rgba(255,255,255,.9); background: rgba(255,255,255,.06); text-decoration: none; }
        .cl-nav-item.active {
            background: #2563EB; color: #fff;
        }

        /* Logout at bottom */
        .cl-sidebar-footer {
            padding: 16px 12px 24px;
            border-top: 1px solid rgba(255,255,255,.08);
        }
        .cl-logout-form { margin: 0; }
        .cl-logout-btn {
            display: flex; align-items: center; gap: 12px;
            padding: 11px 14px; border-radius: 10px;
            color: rgba(255,255,255,.6); text-decoration: none;
            font-size: 14px; font-weight: 500;
            transition: background .2s, color .2s;
            background: none; border: none; width: 100%; cursor: pointer;
        }
        .cl-logout-btn i { width: 18px; text-align: center; }
        .cl-logout-btn:hover { color: rgba(255,255,255,.9); background: rgba(255,255,255,.06); }

        /* ── Main ── */
        .cl-main {
            margin-left: 240px; flex: 1;
            padding: 28px 32px;
            min-height: 100vh;
        }

        /* Tablet landscape — narrow the sidebar slightly */
        @media (max-width: 1024px) {
            .cl-sidebar { width: 210px; }
            .cl-main { margin-left: 210px; padding: 24px 20px; }
        }

        @media (max-width: 768px) {
            .cl-sidebar { width: 240px; transform: translateX(-100%); transition: transform .3s; }
            .cl-sidebar.open { transform: translateX(0); }
            .cl-sidebar-overlay { display: block; }
            .cl-main { margin-left: 0; padding: 20px 16px; }
            .cl-hamburger { display: flex; }
        }

        @media (max-width: 480px) {
            .cl-main { padding: 14px 12px; }
        }

        /* Hamburger button — hidden on desktop */
        .cl-hamburger {
            display: none;
            position: fixed;
            top: 14px;
            left: 14px;
            z-index: 200;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: #0D1F35;
            border: none;
            color: #fff;
            font-size: 18px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0,0,0,.25);
        }

        /* Tap-to-close overlay */
        .cl-sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            z-index: 99;
        }
    </style>
    @yield('css')
</head>
<body>
<button class="cl-hamburger" id="clHamburger" aria-label="Open menu" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>
<div class="cl-sidebar-overlay" id="clOverlay" onclick="toggleSidebar()"></div>

<div class="cl-layout">

    {{-- ── Sidebar ── --}}
    <aside class="cl-sidebar" id="clSidebar">
        <div class="cl-sidebar-brand">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Ubuvivi Tours">
            <span>UBUVIVI Tours</span>
        </div>

        <nav class="cl-nav">
            <a href="{{ route('client.dashboard') }}"
               class="cl-nav-item {{ request()->is('client/dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a href="{{ route('client.bookings') }}"
               class="cl-nav-item {{ request()->is('client/bookings') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i> My Bookings
            </a>
            <a href="{{ route('client.notifications') }}"
               class="cl-nav-item {{ request()->is('client/notifications') ? 'active' : '' }}">
                <i class="fas fa-bell"></i> Notifications
            </a>
            <a href="{{ route('client.profile') }}"
               class="cl-nav-item {{ request()->is('client/profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i> Profile
            </a>
        </nav>

        <div class="cl-sidebar-footer">
            <form action="{{ route('logout') }}" method="POST" class="cl-logout-form"
                  onsubmit="localStorage.clear(); sessionStorage.clear();">
                @csrf
                <button type="submit" class="cl-logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ── Main content ── --}}
    <main class="cl-main" id="clMain">
        @yield('content')
    </main>

</div>

<script>
function toggleSidebar() {
    var sidebar = document.getElementById('clSidebar');
    var overlay = document.getElementById('clOverlay');
    sidebar.classList.toggle('open');
    if (overlay) overlay.style.display = sidebar.classList.contains('open') ? 'block' : 'none';
}
</script>
@yield('scripts')
</body>
</html>

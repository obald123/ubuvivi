<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - UBUVIVI Tours</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #f0f2f8; color: #1a1a2e; }

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

        @media (max-width: 768px) {
            .cl-sidebar { transform: translateX(-100%); transition: transform .3s; }
            .cl-sidebar.open { transform: translateX(0); }
            .cl-main { margin-left: 0; padding: 20px 16px; }
        }
    </style>
    @yield('css')
</head>
<body>
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
            <form id="cl-logout-form" action="{{ url('/logout') }}" method="POST" style="display:none;">@csrf</form>
            <button class="cl-logout-btn"
                    onclick="document.getElementById('cl-logout-form').submit()">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </div>
    </aside>

    {{-- ── Main content ── --}}
    <main class="cl-main" id="clMain">
        @yield('content')
    </main>

</div>

<script>
function toggleSidebar() {
    document.getElementById('clSidebar').classList.toggle('open');
}
</script>
@yield('scripts')
</body>
</html>

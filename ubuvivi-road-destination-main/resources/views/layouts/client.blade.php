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
            <img src="{{ asset('img/android-chrome-512x512.png?v=1') }}" alt="Ubuvivi Tours">
            <span>UBUVIVI Tours</span>
        </div>

        <nav class="cl-nav">
            <a href="{{ route('client.dashboard') }}"
               class="cl-nav-item {{ request()->is('client/dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span data-en="Dashboard" data-fr="Tableau de bord">Dashboard</span>
            </a>
            <a href="{{ route('client.bookings') }}"
               class="cl-nav-item {{ request()->is('client/bookings') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i>
                <span data-en="My Bookings" data-fr="Mes réservations">My Bookings</span>
            </a>
            <a href="{{ route('client.notifications') }}"
               class="cl-nav-item {{ request()->is('client/notifications') ? 'active' : '' }}">
                <i class="fas fa-bell"></i>
                <span data-en="Notifications" data-fr="Notifications">Notifications</span>
            </a>
            <a href="{{ route('client.profile') }}"
               class="cl-nav-item {{ request()->is('client/profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span data-en="Profile" data-fr="Profil">Profile</span>
            </a>
        </nav>

        <div class="cl-sidebar-footer">
            {{-- Language toggle --}}
            <div style="display:flex;align-items:center;justify-content:center;gap:8px;margin-bottom:14px;">
                <button id="cl-lang-en" onclick="setLang('en')"
                    style="flex:1;border:1.5px solid rgba(255,255,255,.2);border-radius:7px;padding:7px 0;font-size:13px;font-weight:700;cursor:pointer;background:transparent;color:rgba(255,255,255,.55);transition:all .2s;letter-spacing:.5px;">
                    EN
                </button>
                <button id="cl-lang-fr" onclick="setLang('fr')"
                    style="flex:1;border:1.5px solid rgba(255,255,255,.2);border-radius:7px;padding:7px 0;font-size:13px;font-weight:700;cursor:pointer;background:transparent;color:rgba(255,255,255,.55);transition:all .2s;letter-spacing:.5px;">
                    FR
                </button>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="cl-logout-form"
                  onsubmit="localStorage.removeItem('cl_locale'); sessionStorage.clear();">
                @csrf
                <button type="submit" class="cl-logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span data-en="Logout" data-fr="Déconnexion">Logout</span>
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

/* ── Language switcher ── */
function applyLang(lang) {
    document.querySelectorAll('[data-en]').forEach(function(el) {
        var text = lang === 'fr' ? (el.getAttribute('data-fr') || el.getAttribute('data-en')) : el.getAttribute('data-en');
        if (!text) return;
        // Inputs/textareas: update placeholder only
        if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
            el.placeholder = text;
        } else {
            el.textContent = text;
        }
    });
    // Highlight active lang button in sidebar
    var enBtn = document.getElementById('cl-lang-en');
    var frBtn = document.getElementById('cl-lang-fr');
    if (enBtn && frBtn) {
        if (lang === 'fr') {
            frBtn.style.background = 'rgba(255,255,255,.15)';
            frBtn.style.color = '#fff';
            frBtn.style.borderColor = 'rgba(255,255,255,.5)';
            enBtn.style.background = 'transparent';
            enBtn.style.color = 'rgba(255,255,255,.55)';
            enBtn.style.borderColor = 'rgba(255,255,255,.2)';
        } else {
            enBtn.style.background = 'rgba(255,255,255,.15)';
            enBtn.style.color = '#fff';
            enBtn.style.borderColor = 'rgba(255,255,255,.5)';
            frBtn.style.background = 'transparent';
            frBtn.style.color = 'rgba(255,255,255,.55)';
            frBtn.style.borderColor = 'rgba(255,255,255,.2)';
        }
    }
    // Highlight profile page buttons if they exist
    var pEn = document.getElementById('lang-en-btn');
    var pFr = document.getElementById('lang-fr-btn');
    if (pEn && pFr) {
        if (lang === 'fr') {
            pFr.style.background = '#0D1F35'; pFr.style.color = '#fff'; pFr.style.borderColor = '#0D1F35';
            pEn.style.background = '#fff';    pEn.style.color = '#1a1a2e'; pEn.style.borderColor = '#e0e0e0';
        } else {
            pEn.style.background = '#0D1F35'; pEn.style.color = '#fff'; pEn.style.borderColor = '#0D1F35';
            pFr.style.background = '#fff';    pFr.style.color = '#1a1a2e'; pFr.style.borderColor = '#e0e0e0';
        }
    }
}

function setLang(lang) {
    localStorage.setItem('cl_locale', lang);
    applyLang(lang);
}

document.addEventListener('DOMContentLoaded', function() {
    applyLang(localStorage.getItem('cl_locale') || 'en');
});
</script>
@yield('scripts')
</body>
</html>

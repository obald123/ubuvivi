:root {
    --orange: #C85A2A;
    --navy: #0D1F35;
    --navbar-height: 96px;
}

/* ── Base navbar ── */
.ubu-navbar {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 1000;
    min-height: var(--navbar-height);
    padding: 18px 40px;
    background: rgba(13, 31, 53, 0.52);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    border-bottom: 1px solid rgba(255,255,255,0.08);
    box-shadow: 0 12px 40px rgba(7, 20, 31, .16);
    transition: background .25s, padding .25s, box-shadow .25s;
}

body:not(.hero-page) .ubu-navbar      { background: rgba(13, 31, 53, 0.97); }
body:not(.hero-page) .ubu-navbar.scrolled { background: #0D1F35; }
.ubu-navbar.scrolled { background: rgba(13, 31, 53, 0.72); box-shadow: 0 16px 44px rgba(7,20,31,.24); padding: 12px 40px; }

.ubu-navbar .navbar-brand img { height: 60px; }

/* ── Nav links ── */
.ubu-navbar .nav-link {
    color: #fff !important;
    font-weight: 500;
    font-size: 15px;
    padding: 6px 14px !important;
    opacity: .92;
    transition: color .2s, opacity .2s;
}
.ubu-navbar .nav-link:hover,
.ubu-navbar .nav-link.active-link {
    color: var(--orange) !important;
    opacity: 1;
}

/* ── Dropdown ── */
.ubu-navbar .dropdown-menu {
    border: none;
    border-radius: 10px;
    box-shadow: 0 8px 30px rgba(0,0,0,.15);
    background: rgba(13, 31, 53, .95);
    backdrop-filter: blur(16px);
    min-width: 180px;
    margin-top: 10px;
}
.ubu-navbar .dropdown-item { color: #fff; padding: 10px 20px; font-size: 14px; }
.ubu-navbar .dropdown-item:hover { background: var(--orange); color: #fff; }

/* ── Plan Your Trip button (desktop) ── */
.plan-trip-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,.1);
    color: #fff !important;
    border-radius: 50px;
    padding: 11px 24px;
    font-weight: 600;
    font-size: 14px;
    border: 1px solid rgba(255,255,255,.16);
    white-space: nowrap;
    transition: background .2s, border-color .2s;
}
.plan-trip-btn:hover { background: var(--orange); border-color: var(--orange); color: #fff !important; text-decoration: none; }

/* ── Hamburger: hidden on desktop, shown on mobile ── */
.ubu-navbar .navbar-toggler {
    border: none;
    outline: none !important;
    box-shadow: none !important;
    background: transparent;
    padding: 0;
    /* Bootstrap hides this at lg+ via .navbar-expand-lg — we don't override that */
}
.ubu-navbar .navbar-toggler-icon { display: none; }
.ubu-navbar .navbar-toggler .hbg-bar {
    display: block;
    width: 22px;
    height: 2px;
    background: #fff;
    border-radius: 2px;
    transition: transform .3s ease, opacity .3s ease, width .3s ease;
    transform-origin: center;
}
/* X animation when open */
.ubu-navbar .navbar-toggler[aria-expanded="true"] .hbg-bar:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.ubu-navbar .navbar-toggler[aria-expanded="true"] .hbg-bar:nth-child(2) { opacity: 0; width: 0; }
.ubu-navbar .navbar-toggler[aria-expanded="true"] .hbg-bar:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

/* ── Mobile menu (< 992px) ── */
@media (max-width: 991px) {
    :root { --navbar-height: 80px; }

    .ubu-navbar { padding: 10px 18px; }
    .ubu-navbar .navbar-brand img { height: 48px; }

    /* Style the toggler button itself on mobile */
    .ubu-navbar .navbar-toggler {
        background: rgba(255,255,255,.1);
        border-radius: 8px;
        width: 44px;
        height: 44px;
        display: flex !important;   /* override Bootstrap's block on mobile */
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 5px;
        cursor: pointer;
        transition: background .2s;
    }
    .ubu-navbar .navbar-toggler:hover { background: rgba(200,90,42,.25); }

    /* Full-width dropdown panel */
    .ubu-navbar .navbar-collapse {
        position: fixed;
        top: var(--navbar-height);
        left: 0; right: 0;
        max-height: calc(100vh - var(--navbar-height));
        overflow-y: auto;
        background: rgba(9, 22, 40, 0.98);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-top: 1px solid rgba(255,255,255,.08);
        padding: 16px 20px 24px;
        box-shadow: 0 12px 40px rgba(0,0,0,.4);
        z-index: 999;
    }

    .ubu-navbar .navbar-nav {
        gap: 2px;
        padding-bottom: 12px;
        border-bottom: 1px solid rgba(255,255,255,.08);
        margin-bottom: 16px;
    }
    .ubu-navbar .nav-item { width: 100%; }
    .ubu-navbar .nav-link {
        padding: 12px 16px !important;
        border-radius: 10px;
        font-size: 15px;
        transition: background .2s;
    }
    .ubu-navbar .nav-link:hover,
    .ubu-navbar .nav-link.active-link {
        background: rgba(200,90,42,.15);
        color: var(--orange) !important;
    }

    /* Dropdown inside mobile menu */
    .ubu-navbar .dropdown-menu {
        position: static !important;
        float: none;
        box-shadow: none;
        background: rgba(255,255,255,.04);
        border-radius: 10px;
        margin: 6px 0 0;
        padding: 4px;
        border: 1px solid rgba(255,255,255,.06);
    }
    .ubu-navbar .dropdown-item { border-radius: 8px; padding: 10px 16px; }

    /* Plan Your Trip inside mobile menu */
    .plan-trip-mobile {
        display: flex !important;
        width: 100%;
        justify-content: center;
        text-align: center;
        background: var(--orange);
        border-radius: 12px;
        padding: 14px 24px;
        font-size: 15px;
        font-weight: 700;
        color: #fff !important;
        text-decoration: none;
        transition: background .2s;
    }
    .plan-trip-mobile:hover { background: #a84520; color: #fff !important; }
}

@media (max-width: 576px) {
    .ubu-navbar { padding: 8px 14px; }
    .ubu-navbar .navbar-brand img { height: 42px; }
}

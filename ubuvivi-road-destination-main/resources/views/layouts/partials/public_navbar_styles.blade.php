:root {
    --orange: #C85A2A;
    --navy: #0D1F35;
    --navy-light: #162032;
    --navbar-height: 96px;
}

.ubu-navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    min-height: var(--navbar-height);
    padding: 18px 40px;
    background: rgba(13, 31, 53, 0.52);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    border-bottom: 1px solid rgba(255,255,255,0.08);
    box-shadow: 0 12px 40px rgba(7, 20, 31, .16);
    transition: background .25s ease, padding .25s ease, box-shadow .25s ease;
}

body:not(.hero-page) .ubu-navbar {
    background: rgba(13, 31, 53, 0.97);
}

body:not(.hero-page) .ubu-navbar.scrolled {
    background: #0D1F35;
}

.ubu-navbar .navbar-brand img {
    height: 60px;
}

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

.ubu-navbar .navbar-toggler {
    border-color: rgba(255,255,255,.5);
    outline: none;
    box-shadow: none;
}

.ubu-navbar .navbar-toggler-icon {
    filter: invert(1);
}

.ubu-navbar.scrolled {
    background: rgba(13, 31, 53, 0.72);
    box-shadow: 0 16px 44px rgba(7, 20, 31, .24);
    padding: 12px 40px;
}

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

.plan-trip-btn:hover {
    background: var(--orange);
    border-color: var(--orange);
    color: #fff !important;
    text-decoration: none;
}

.ubu-navbar .dropdown-menu {
    border: none;
    border-radius: 10px;
    box-shadow: 0 8px 30px rgba(0,0,0,.15);
    background: rgba(13, 31, 53, .92);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    min-width: 180px;
    margin-top: 10px;
}

.ubu-navbar .dropdown-item {
    color: #fff;
    padding: 10px 20px;
    font-size: 14px;
}

.ubu-navbar .dropdown-item:hover {
    background: var(--orange);
    color: #fff;
}

@media (max-width: 767px) {
    :root {
        --navbar-height: 86px;
    }

    .ubu-navbar {
        padding: 12px 16px;
    }

    .ubu-navbar .navbar-brand img {
        height: 52px;
    }

    .ubu-navbar .navbar-collapse {
        margin-top: 14px;
        padding: 14px 16px;
        border-radius: 18px;
        background: rgba(13, 31, 53, .88);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border: 1px solid rgba(255,255,255,.08);
    }

    .ubu-navbar .navbar-nav {
        gap: 6px;
    }

    .ubu-navbar .nav-link {
        padding: 10px 0 !important;
    }
}

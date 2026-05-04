@extends('layouts.client')

@section('title')
    Profile
@endsection

@section('css')
<style>
    .cd-topbar { display:flex; align-items:center; justify-content:space-between; margin-bottom:30px; gap:14px; flex-wrap:wrap; }
    .cd-search { display:flex; align-items:center; gap:10px; background:#fff; border:1px solid #e4e4e8; border-radius:10px; padding:10px 18px; flex:1; max-width:480px; }
    .cd-search i { color:#bbb; font-size:14px; }
    .cd-search input { border:none; outline:none; background:transparent; font-size:14px; color:#333; width:100%; }
    .cd-search input::placeholder { color:#bbb; }
    .cd-new-btn { background:#0D1F35; color:#fff; border:none; border-radius:50px; padding:10px 22px; font-size:14px; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:7px; white-space:nowrap; text-decoration:none; transition:background .2s; }
    .cd-new-btn:hover { background:#1e3a5f; color:#fff; text-decoration:none; }

    .pr-wrap { max-width:720px; }

    /* Profile card */
    .pr-card {
        background:#fff; border-radius:16px;
        box-shadow:0 1px 8px rgba(0,0,0,.06);
        padding:28px 28px 24px;
        margin-bottom:24px;
        position:relative;
    }
    .pr-card-top { display:flex; align-items:center; gap:20px; }
    .pr-avatar-wrap { position:relative; flex-shrink:0; }
    .pr-avatar {
        width:72px; height:72px; border-radius:50%;
        background:#0D1F35; color:#fff;
        display:flex; align-items:center; justify-content:center;
        font-size:26px; font-weight:700; letter-spacing:1px;
        user-select:none;
    }
    .pr-avatar-cam {
        position:absolute; bottom:0; right:0;
        width:24px; height:24px; border-radius:50%;
        background:#2563EB; color:#fff;
        display:flex; align-items:center; justify-content:center;
        font-size:11px; cursor:pointer; border:2px solid #fff;
    }
    .pr-info { flex:1; min-width:0; }
    .pr-name { font-size:18px; font-weight:800; color:#1a1a2e; margin-bottom:4px; }
    .pr-email { font-size:14px; color:#888; }
    .pr-edit-btn {
        position:absolute; top:24px; right:24px;
        background:#0D1F35; color:#fff;
        border:none; border-radius:50px;
        padding:9px 20px; font-size:13px; font-weight:600;
        cursor:pointer; display:inline-flex; align-items:center; gap:7px;
        transition:background .2s; text-decoration:none;
    }
    .pr-edit-btn:hover { background:#1e3a5f; color:#fff; text-decoration:none; }

    .pr-divider { border:none; border-top:1px solid #f0f0f0; margin:20px 0; }

    .pr-change-pw {
        display:inline-flex; align-items:center; gap:8px;
        font-size:14px; color:#1a1a2e; font-weight:500;
        text-decoration:none; cursor:pointer;
    }
    .pr-change-pw i { color:#888; font-size:15px; }
    .pr-change-pw:hover { color:#2563EB; text-decoration:none; }
    .pr-change-pw:hover i { color:#2563EB; }

    /* Section headings */
    .pr-section-title { font-size:11px; font-weight:700; color:#aaa; letter-spacing:.8px; text-transform:uppercase; margin-bottom:10px; }

    /* Preference / Support rows */
    .pr-rows { background:#fff; border-radius:16px; box-shadow:0 1px 8px rgba(0,0,0,.06); overflow:hidden; margin-bottom:24px; }
    .pr-row {
        display:flex; align-items:center; justify-content:space-between;
        padding:16px 20px; border-bottom:1px solid #f5f5f5;
        cursor:pointer; transition:background .15s;
    }
    .pr-row:last-child { border-bottom:none; }
    .pr-row:hover { background:#fafafa; }
    .pr-row-left { display:flex; align-items:center; gap:14px; }
    .pr-row-icon {
        width:38px; height:38px; border-radius:10px;
        display:flex; align-items:center; justify-content:center;
        font-size:15px; flex-shrink:0;
    }
    .ri-blue   { background:#EEF2FF; color:#4F6CDE; }
    .ri-green  { background:#E8F8F0; color:#27AE60; }
    .ri-yellow { background:#FFF8E6; color:#F0A500; }
    .ri-red    { background:#FEF2F2; color:#E53E3E; }
    .pr-row-label { font-size:14px; font-weight:500; color:#1a1a2e; }
    .pr-row-value { font-size:13px; color:#888; }
    .pr-row-chevron { color:#ccc; font-size:13px; }
</style>
@endsection

@section('content')

    {{-- Topbar --}}
    <div class="cd-topbar">
        <div class="cd-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search...">
        </div>
        <a href="{{ route('client.new_booking') }}" class="cd-new-btn">
            <i class="fas fa-plus"></i> New Booking
        </a>
    </div>

    <div class="pr-wrap">

        {{-- Profile card --}}
        <div class="pr-card">
            <a href="#" class="pr-edit-btn">
                <i class="fas fa-pen"></i> Edit Profile
            </a>

            <div class="pr-card-top">
                <div class="pr-avatar-wrap">
                    <div class="pr-avatar">
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}{{ strtoupper(substr(strstr($user->name ?? ' U', ' '), 1, 1)) }}
                    </div>
                    <div class="pr-avatar-cam"><i class="fas fa-camera"></i></div>
                </div>
                <div class="pr-info">
                    <div class="pr-name">{{ $user->name ?? 'User' }}</div>
                    <div class="pr-email">{{ $user->email ?? '' }}</div>
                </div>
            </div>

            <hr class="pr-divider">

            <a href="#" class="pr-change-pw">
                <i class="fas fa-lock"></i> Change Password
            </a>
        </div>

        {{-- App Preferences --}}
        <div class="pr-section-title">App preferences</div>
        <div class="pr-rows">
            <div class="pr-row">
                <div class="pr-row-left">
                    <div class="pr-row-icon ri-blue"><i class="fas fa-globe"></i></div>
                    <span class="pr-row-label">Language selection</span>
                </div>
                <div style="display:flex;align-items:center;gap:10px;">
                    <span class="pr-row-value">English (USA)</span>
                    <i class="fas fa-chevron-right pr-row-chevron"></i>
                </div>
            </div>
        </div>

        {{-- Support & About --}}
        <div class="pr-section-title">Support &amp; about</div>
        <div class="pr-rows">
            <div class="pr-row">
                <div class="pr-row-left">
                    <div class="pr-row-icon ri-green"><i class="fas fa-question-circle"></i></div>
                    <span class="pr-row-label">Contact support</span>
                </div>
                <i class="fas fa-chevron-right pr-row-chevron"></i>
            </div>
            <div class="pr-row">
                <div class="pr-row-left">
                    <div class="pr-row-icon ri-blue"><i class="fas fa-file-alt"></i></div>
                    <span class="pr-row-label">Terms of services</span>
                </div>
                <i class="fas fa-chevron-right pr-row-chevron"></i>
            </div>
            <div class="pr-row">
                <div class="pr-row-left">
                    <div class="pr-row-icon ri-yellow"><i class="fas fa-exclamation-triangle"></i></div>
                    <span class="pr-row-label">Report a problem</span>
                </div>
                <i class="fas fa-chevron-right pr-row-chevron"></i>
            </div>
        </div>

    </div>

@endsection

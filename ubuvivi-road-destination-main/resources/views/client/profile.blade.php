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

    /* Flash messages */
    .pr-flash { padding:10px 16px; border-radius:10px; margin-bottom:18px; font-size:14px; font-weight:500; }
    .pr-flash.success { background:#E8F8F0; color:#1e7e4a; border:1px solid #b7e4ca; }
    .pr-flash.error   { background:#FDECEA; color:#c62828; border:1px solid #f5c6c6; }

    /* Profile card */
    .pr-card {
        background:#fff; border-radius:16px;
        box-shadow:0 1px 8px rgba(0,0,0,.06);
        padding:28px 28px 24px;
        margin-bottom:24px;
    }
    .pr-card-top { display:flex; align-items:center; gap:20px; margin-bottom:20px; }
    .pr-avatar-wrap { position:relative; flex-shrink:0; cursor:pointer; }
    .pr-avatar {
        width:72px; height:72px; border-radius:50%;
        background:#0D1F35; color:#fff;
        display:flex; align-items:center; justify-content:center;
        font-size:26px; font-weight:700; letter-spacing:1px;
        user-select:none; overflow:hidden;
    }
    .pr-avatar img { width:72px; height:72px; object-fit:cover; border-radius:50%; display:block; }
    .pr-avatar-cam {
        position:absolute; bottom:0; right:0;
        width:24px; height:24px; border-radius:50%;
        background:#2563EB; color:#fff;
        display:flex; align-items:center; justify-content:center;
        font-size:11px; border:2px solid #fff;
    }
    .pr-info { flex:1; min-width:0; }
    .pr-name  { font-size:18px; font-weight:800; color:#1a1a2e; margin-bottom:4px; }
    .pr-email { font-size:14px; color:#888; }

    /* Edit form */
    .pr-edit-section { display:none; }
    .pr-edit-section.open { display:block; }
    .pr-form-group { margin-bottom:16px; }
    .pr-form-group label { display:block; font-size:13px; font-weight:600; color:#555; margin-bottom:6px; }
    .pr-form-group input {
        width:100%; padding:11px 14px;
        border:1.5px solid #e0e0e0; border-radius:8px;
        font-size:14px; outline:none; color:#1a1a2e;
        background:#fff; transition:border-color .2s;
    }
    .pr-form-group input:focus { border-color:#2563EB; }
    .pr-form-error { color:#e53935; font-size:12px; margin-top:4px; }
    .pr-form-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
    .pr-btn-row { display:flex; gap:10px; margin-top:4px; }
    .pr-btn-save {
        background:#0D1F35; color:#fff; border:none;
        border-radius:8px; padding:11px 24px;
        font-size:14px; font-weight:600; cursor:pointer; transition:background .2s;
    }
    .pr-btn-save:hover { background:#1e3a5f; }
    .pr-btn-cancel {
        background:#fff; color:#555; border:1.5px solid #ddd;
        border-radius:8px; padding:11px 20px;
        font-size:14px; font-weight:500; cursor:pointer; transition:all .2s;
    }
    .pr-btn-cancel:hover { border-color:#aaa; color:#333; }

    .pr-edit-toggle {
        display:inline-flex; align-items:center; gap:7px;
        background:#f5f7fa; border:1.5px solid #e0e0e0;
        border-radius:8px; padding:9px 18px;
        font-size:13px; font-weight:600; color:#374151;
        cursor:pointer; transition:all .2s; margin-top:4px;
    }
    .pr-edit-toggle:hover { background:#e8ecf2; }

    .pr-divider { border:none; border-top:1px solid #f0f0f0; margin:20px 0; }

    /* Password section */
    .pr-pw-toggle {
        display:inline-flex; align-items:center; gap:8px;
        font-size:14px; color:#1a1a2e; font-weight:500;
        background:none; border:none; cursor:pointer; padding:0;
    }
    .pr-pw-toggle i { color:#888; font-size:15px; }
    .pr-pw-toggle:hover { color:#2563EB; }
    .pr-pw-toggle:hover i { color:#2563EB; }
    .pr-pw-section { display:none; margin-top:16px; }
    .pr-pw-section.open { display:block; }

    /* Section headings */
    .pr-section-title { font-size:11px; font-weight:700; color:#aaa; letter-spacing:.8px; text-transform:uppercase; margin-bottom:10px; }

    /* Preference / Support rows */
    .pr-rows { background:#fff; border-radius:16px; box-shadow:0 1px 8px rgba(0,0,0,.06); overflow:hidden; margin-bottom:24px; }
    .pr-row {
        display:flex; align-items:center; justify-content:space-between;
        padding:16px 20px; border-bottom:1px solid #f5f5f5;
        transition:background .15s;
    }
    .pr-row:last-child { border-bottom:none; }
    .pr-row-left { display:flex; align-items:center; gap:14px; }
    .pr-row-icon {
        width:38px; height:38px; border-radius:10px;
        display:flex; align-items:center; justify-content:center;
        font-size:15px; flex-shrink:0;
    }
    .ri-blue   { background:#EEF2FF; color:#4F6CDE; }
    .ri-green  { background:#E8F8F0; color:#27AE60; }
    .ri-yellow { background:#FFF8E6; color:#F0A500; }
    .pr-row-label { font-size:14px; font-weight:500; color:#1a1a2e; }
    .pr-row-value { font-size:13px; color:#888; }
    .pr-row-chevron { color:#ccc; font-size:13px; }

    @media(max-width:576px) {
        .pr-form-row { grid-template-columns:1fr; }
        .pr-wrap { max-width:100%; }
    }
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

        {{-- Flash messages --}}
        @if(session('profile_success'))
            <div class="pr-flash success"><i class="fas fa-check-circle"></i> {{ session('profile_success') }}</div>
        @endif
        @if(session('password_success'))
            <div class="pr-flash success"><i class="fas fa-check-circle"></i> {{ session('password_success') }}</div>
        @endif
        @if($errors->has('current_password'))
            <div class="pr-flash error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first('current_password') }}</div>
        @endif

        {{-- Profile card --}}
        <div class="pr-card">

            {{-- Avatar + name display --}}
            <div class="pr-card-top">
                <form id="avatarForm" action="{{ route('client.profile.update') }}" method="POST" enctype="multipart/form-data" style="display:contents">
                    @csrf @method('PUT')
                    <div class="pr-avatar-wrap" onclick="document.getElementById('avatarInput').click()" title="Change photo">
                        <div class="pr-avatar" id="avatarDisplay">
                            @if(!empty($user->avatar))
                                <img src="{{ $user->avatar }}" alt="Avatar" id="avatarImg">
                            @else
                                <span id="avatarInitials">{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}{{ strtoupper(substr(strstr($user->name ?? ' U', ' '), 1, 1)) }}</span>
                            @endif
                        </div>
                        <div class="pr-avatar-cam"><i class="fas fa-camera"></i></div>
                        <input type="hidden" name="name" value="{{ $user->name }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="file" name="avatar" id="avatarInput" accept="image/*" style="display:none" onchange="previewAvatar(this)">
                    </div>
                </form>
                <div class="pr-info">
                    <div class="pr-name" id="displayName">{{ $user->name ?? 'User' }}</div>
                    <div class="pr-email" id="displayEmail">{{ $user->email ?? '' }}</div>
                    <button type="button" class="pr-edit-toggle" id="editToggleBtn" onclick="toggleEdit()">
                        <i class="fas fa-pen"></i> Edit Profile
                    </button>
                </div>
            </div>

            {{-- Edit profile form --}}
            <div class="pr-edit-section {{ session('profile_success') || $errors->hasAny(['name','email']) ? 'open' : '' }}" id="editSection">
                <form action="{{ route('client.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <input type="hidden" name="avatar" value="">
                    <div class="pr-form-row">
                        <div class="pr-form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')<div class="pr-form-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="pr-form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')<div class="pr-form-error">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="pr-btn-row">
                        <button type="submit" class="pr-btn-save">Save Changes</button>
                        <button type="button" class="pr-btn-cancel" onclick="toggleEdit()">Cancel</button>
                    </div>
                </form>
            </div>

            <hr class="pr-divider">

            {{-- Change password --}}
            <button type="button" class="pr-pw-toggle" id="pwToggleBtn" onclick="togglePassword()">
                <i class="fas fa-lock"></i> Change Password
            </button>

            <div class="pr-pw-section {{ session('open_password') || $errors->has('current_password') ? 'open' : '' }}" id="pwSection">
                <form action="{{ route('client.profile.password') }}" method="POST" style="margin-top:0">
                    @csrf @method('PUT')
                    <div class="pr-form-group" style="margin-top:16px">
                        <label>Current Password</label>
                        <input type="password" name="current_password" placeholder="Enter current password" required>
                    </div>
                    <div class="pr-form-row">
                        <div class="pr-form-group">
                            <label>New Password</label>
                            <input type="password" name="password" placeholder="Min. 8 characters" required>
                            @error('password')<div class="pr-form-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="pr-form-group">
                            <label>Confirm New Password</label>
                            <input type="password" name="password_confirmation" placeholder="Repeat new password" required>
                        </div>
                    </div>
                    <div class="pr-btn-row">
                        <button type="submit" class="pr-btn-save">Update Password</button>
                        <button type="button" class="pr-btn-cancel" onclick="togglePassword()">Cancel</button>
                    </div>
                </form>
            </div>

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

@section('scripts')
<script>
function toggleEdit() {
    var sec = document.getElementById('editSection');
    sec.classList.toggle('open');
}

function togglePassword() {
    var sec = document.getElementById('pwSection');
    sec.classList.toggle('open');
}

function previewAvatar(input) {
    if (!input.files || !input.files[0]) return;
    var reader = new FileReader();
    reader.onload = function(e) {
        var display = document.getElementById('avatarDisplay');
        display.innerHTML = '<img src="' + e.target.result + '" alt="Avatar" style="width:72px;height:72px;object-fit:cover;border-radius:50%;display:block;">';
    };
    reader.readAsDataURL(input.files[0]);
    // Auto-submit the avatar form
    document.getElementById('avatarForm').submit();
}
</script>
@endsection

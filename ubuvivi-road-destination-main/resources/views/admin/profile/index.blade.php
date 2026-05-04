@extends('layouts.app')

@section('title')
    Profile
@endsection

@section('css')
<style>
    .adm-topbar { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:14px; }
    .adm-topbar h1 { font-size:28px; font-weight:800; color:#1a1a2e; margin:0; }
    .adm-topbar-right { display:flex; align-items:center; gap:12px; }
    .adm-search { display:flex; align-items:center; gap:10px; background:#fff; border:1px solid #e8e8e8; border-radius:10px; padding:9px 16px; width:260px; }
    .adm-search i { color:#bbb; font-size:14px; }
    .adm-search input { border:none; outline:none; background:transparent; font-size:14px; color:#333; width:100%; }
    .adm-search input::placeholder { color:#bbb; }
    .adm-bell { width:40px; height:40px; border-radius:50%; background:#fff; border:1px solid #e8e8e8; display:flex; align-items:center; justify-content:center; color:#666; cursor:pointer; position:relative; }
    .adm-bell-dot { position:absolute; top:9px; right:9px; width:8px; height:8px; border-radius:50%; background:#e74c3c; border:2px solid #fff; }
    .adm-avatar { width:40px; height:40px; border-radius:50%; background:#1a1a2e; color:#fff; display:flex; align-items:center; justify-content:center; font-size:15px; font-weight:700; cursor:pointer; }
    .adm-new-btn { background:#0D1F35; color:#fff; border:none; border-radius:10px; padding:10px 20px; font-size:14px; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:8px; white-space:nowrap; transition:background .2s; }
    .adm-new-btn:hover { background:#1e3a5f; }

    /* Tabs */
    .pr-tabbar { display:flex; align-items:center; border-bottom:1px solid #e8e8e8; margin-bottom:24px; }
    .pr-tab { padding:12px 22px; font-size:14px; font-weight:500; color:#888; cursor:pointer; border:none; background:none; border-bottom:2px solid transparent; margin-bottom:-1px; transition:color .2s; }
    .pr-tab.active { color:#1a1a2e; border-bottom-color:#1a1a2e; font-weight:600; }
    .pr-tab:hover:not(.active) { color:#555; }

    .tab-pane { display:none; }
    .tab-pane.active { display:block; }

    /* Profile form panel */
    .pr-panel { background:#fff; border-radius:16px; box-shadow:0 1px 8px rgba(0,0,0,.06); padding:28px 32px; max-width:740px; }
    .form-row2 { display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px; }
    @media(max-width:640px) { .form-row2 { grid-template-columns:1fr; } }
    .pr-form-group { margin-bottom:0; }
    .pr-form-group label { display:block; font-size:13px; font-weight:600; color:#1a1a2e; margin-bottom:7px; }
    .pr-form-group input { width:100%; padding:11px 14px; border:1px solid #e0e0e0; border-radius:8px; font-size:14px; outline:none; }
    .pr-form-group input:focus { border-color:#2563EB; }
    .pr-section-title { font-size:16px; font-weight:700; color:#1a1a2e; margin:24px 0 16px; }
    .pr-section-title:first-child { margin-top:0; }
    .pr-save-btn { background:#0D1F35; color:#fff; border:none; border-radius:8px; padding:11px 28px; font-size:14px; font-weight:600; cursor:pointer; transition:background .2s; margin-top:8px; }
    .pr-save-btn:hover { background:#1e3a5f; }

    /* Users table */
    .users-panel { background:#fff; border-radius:16px; box-shadow:0 1px 8px rgba(0,0,0,.06); padding:24px 28px; }
    .users-table { width:100%; border-collapse:collapse; }
    .users-table th { text-align:left; font-size:13px; font-weight:500; color:#888; padding:10px 14px; border-bottom:1px solid #f0f0f0; }
    .users-table td { padding:14px 14px; font-size:14px; color:#1a1a2e; border-bottom:1px solid #f7f7f7; vertical-align:middle; }
    .users-table tr:last-child td { border-bottom:none; }
    .users-table tr:hover td { background:#fafafa; }
    .role-badge { display:inline-block; padding:3px 12px; border-radius:20px; font-size:12px; font-weight:500; background:#EEF2FF; color:#4F6CDE; }
    .role-admin  { background:#FFF8E6; color:#F0A500; }
    .role-client { background:#E8F8F0; color:#27AE60; }
    .role-staff  { background:#F3EEFF; color:#7B5EE8; }
    .action-btns { display:flex; gap:8px; }
    .btn-icon-edit { width:34px; height:34px; border-radius:8px; background:#0D1F35; color:#fff; border:none; display:flex; align-items:center; justify-content:center; font-size:13px; cursor:pointer; transition:background .2s; }
    .btn-icon-edit:hover { background:#1e3a5f; }
    .btn-icon-del  { width:34px; height:34px; border-radius:8px; background:#E53935; color:#fff; border:none; display:flex; align-items:center; justify-content:center; font-size:13px; cursor:pointer; transition:background .2s; }
    .btn-icon-del:hover { background:#c62828; }
    .no-data { text-align:center; color:#bbb; padding:36px 0; font-size:14px; }

    /* User Modal */
    .adm-modal-overlay { position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,.45); display:flex; align-items:center; justify-content:center; z-index:2000; }
    .adm-modal { background:#fff; border-radius:16px; padding:28px; max-width:520px; width:90%; max-height:90vh; overflow-y:auto; }
    .adm-modal-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
    .adm-modal-head h3 { font-size:18px; font-weight:700; color:#1a1a2e; margin:0; }
    .adm-modal-close { background:none; border:none; font-size:22px; cursor:pointer; color:#aaa; }
    .adm-modal-close:hover { color:#555; }
    .adm-form-group { margin-bottom:16px; }
    .adm-form-group label { display:block; font-size:13px; font-weight:600; color:#1a1a2e; margin-bottom:6px; }
    .adm-form-group input, .adm-form-group select { width:100%; padding:10px 14px; border:1px solid #e0e0e0; border-radius:8px; font-size:14px; outline:none; font-family:inherit; }
    .adm-form-group input:focus, .adm-form-group select:focus { border-color:#2563EB; }
    .adm-modal-foot { display:flex; gap:8px; justify-content:flex-end; margin-top:20px; }
    .btn-save { background:#0D1F35; color:#fff; border:none; padding:10px 24px; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer; }
    .btn-save:hover { background:#1e3a5f; }
    .btn-modal-cancel { background:#f0f0f0; color:#555; border:none; padding:10px 20px; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer; }
    .btn-modal-cancel:hover { background:#e0e0e0; }
</style>
@endsection

@section('content')

    <div class="adm-topbar">
        <h1>Profile</h1>
        <div class="adm-topbar-right">
            <div class="adm-search">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search...">
            </div>
            <div class="adm-bell">
                <i class="fas fa-bell"></i>
                <span class="adm-bell-dot"></span>
            </div>
            <div class="adm-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
            <button class="adm-new-btn" id="btnAddUser">
                <i class="fas fa-plus"></i> User
            </button>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="pr-tabbar">
        <button class="pr-tab active" data-pane="profile">Profile</button>
        <button class="pr-tab" data-pane="security">Security</button>
        <button class="pr-tab" data-pane="users">Users</button>
    </div>

    {{-- Profile tab --}}
    <div class="tab-pane active" id="pane-profile">
        <div class="pr-panel">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf @method('PUT')
                <div class="pr-section-title">Profile Information</div>
                <div class="form-row2">
                    <div class="pr-form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" value="{{ auth()->user()->name }}" required>
                    </div>
                    <div class="pr-form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}" required>
                    </div>
                </div>
                @if(session('success'))
                <div style="color:#27AE60;font-size:13px;margin-bottom:14px;">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                <div style="color:#E53935;font-size:13px;margin-bottom:14px;">{{ $errors->first() }}</div>
                @endif
                <button type="submit" class="pr-save-btn">Save Changes</button>
            </form>
        </div>
    </div>

    {{-- Security tab --}}
    <div class="tab-pane" id="pane-security">
        <div class="pr-panel">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf @method('PUT')
                <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                <div class="pr-section-title">Change Password</div>
                <div class="form-row2">
                    <div class="pr-form-group">
                        <label>Current Password</label>
                        <input type="password" name="current_password">
                    </div>
                    <div class="pr-form-group">
                        <label>New Password</label>
                        <input type="password" name="new_password">
                    </div>
                </div>
                <div class="form-row2">
                    <div class="pr-form-group">
                        <label>Confirm New Password</label>
                        <input type="password" name="new_password_confirmation">
                    </div>
                    <div></div>
                </div>
                <button type="submit" class="pr-save-btn">Update Password</button>
            </form>
        </div>
    </div>

    {{-- Users tab --}}
    <div class="tab-pane" id="pane-users">
        <div class="users-panel">
            @if($users->count())
            <table class="users-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Names</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $i => $u)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->phone_number ?? 'N/A' }}</td>
                        <td>
                            @php $role = strtolower($u->role ?? 'client'); @endphp
                            <span class="role-badge role-{{ $role }}">{{ ucfirst($u->role ?? 'client') }}</span>
                        </td>
                        <td>
                            <div class="action-btns">
                                <button class="btn-icon-edit" title="Edit"><i class="fas fa-pen"></i></button>
                                <button class="btn-icon-del"  title="Delete"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="no-data"><i class="fas fa-users" style="font-size:28px;display:block;margin-bottom:10px;color:#ddd;"></i>No users found.</div>
            @endif
        </div>
    </div>

    {{-- Add User Modal --}}
    <div class="adm-modal-overlay" id="addUserModal" style="display:none;">
        <div class="adm-modal">
            <div class="adm-modal-head">
                <h3>Add User</h3>
                <button class="adm-modal-close" id="closeAddUser">&times;</button>
            </div>
            <div class="adm-form-group">
                <label>Full Name</label>
                <input type="text" placeholder="Full name">
            </div>
            <div class="adm-form-group">
                <label>Email</label>
                <input type="email" placeholder="Email address">
            </div>
            <div class="adm-form-group">
                <label>Phone Number</label>
                <input type="text" placeholder="Phone number">
            </div>
            <div class="adm-form-group">
                <label>Role</label>
                <select>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                    <option value="client">Client</option>
                </select>
            </div>
            <div class="adm-form-group">
                <label>Password</label>
                <input type="password" placeholder="Password">
            </div>
            <div class="adm-modal-foot">
                <button class="btn-modal-cancel" id="cancelAddUser">Cancel</button>
                <button class="btn-save">Create User</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tabs
    document.querySelectorAll('.pr-tab').forEach(function(tab) {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.pr-tab').forEach(function(t){ t.classList.remove('active'); });
            tab.classList.add('active');
            document.querySelectorAll('.tab-pane').forEach(function(p){ p.classList.remove('active'); });
            document.getElementById('pane-' + tab.dataset.pane).classList.add('active');
        });
    });

    // Open Users tab if URL has #users
    if (window.location.hash === '#users') {
        document.querySelector('[data-pane="users"]').click();
    }

    // Add User modal
    var modal = document.getElementById('addUserModal');
    document.getElementById('btnAddUser').addEventListener('click', function() { modal.style.display = 'flex'; });
    document.getElementById('closeAddUser').addEventListener('click', function() { modal.style.display = 'none'; });
    document.getElementById('cancelAddUser').addEventListener('click', function() { modal.style.display = 'none'; });
    modal.addEventListener('click', function(e) { if (e.target === modal) modal.style.display = 'none'; });
});
</script>
@endsection

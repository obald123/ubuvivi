@extends('layouts.app')

@section('title')
    Profile
@endsection

@php
    $activeTab = old('active_tab');

    if (!$activeTab && $errors->has('current_password')) {
        $activeTab = 'security';
    }

    if (!$activeTab && (session('active_tab') || request()->query('tab'))) {
        $activeTab = session('active_tab', request()->query('tab'));
    }

    $activeTab = in_array($activeTab, ['profile', 'security', 'users'], true) ? $activeTab : 'users';
@endphp

@section('css')
<style>
    .profile-page {
        display: flex;
        flex-direction: column;
        gap: 22px;
        width: 100%;
        --admin-search-width: 436px;
    }

    .profile-toolbar {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
        padding: 16px 0;
        border-bottom: 2px solid #f0f0f0;
    }

    .profile-tabs {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        overflow-x: auto;
        max-width: 100%;
    }

    .profile-tab {
        position: relative;
        border: 0;
        background: transparent;
        padding: 10px 18px;
        color: #666;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        white-space: nowrap;
        border-radius: 6px 6px 0 0;
        transition: all .2s ease;
        margin-right: 4px;
    }

    .profile-tab::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: -2px;
        height: 3px;
        border-radius: 2px 2px 0 0;
        background: transparent;
        transition: background .2s ease, width .2s ease;
    }

    .profile-tab.is-active {
        background: #f5f5f5;
        color: #2495e7;
    }

    .profile-tab.is-active::after {
        background: #2495e7;
    }

    .profile-tab:hover {
        background: #f9f9f9;
        color: #1a1a1a;
    }

    .profile-tab:not(.is-active) {
        color: #666;
    }

    .profile-add-user {
        border: 0;
        background: linear-gradient(135deg, #2495e7 0%, #1a7bc7 100%);
        color: #fff;
        height: 38px;
        padding: 0 20px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
        box-shadow: 0 4px 12px rgba(36, 149, 231, .25);
        transition: all .2s ease;
    }

    .profile-add-user:hover {
        background: linear-gradient(135deg, #1a7bc7 0%, #0f5a9e 100%);
        box-shadow: 0 6px 16px rgba(36, 149, 231, .35);
        transform: translateY(-2px);
        color: #fff;
        text-decoration: none;
    }

    .profile-pane {
        display: none;
    }

    .profile-pane.is-active {
        display: block;
        animation: fadeIn .3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .profile-card,
    .users-card {
        background: #fff;
        border: 1px solid #e4e8f0;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(15, 35, 52, .04);
    }

    .profile-card {
        max-width: 760px;
        padding: 28px 30px;
    }

    .profile-card h2 {
        margin: 0 0 20px;
        color: #1f2937;
        font-size: 18px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .profile-field {
        margin-bottom: 18px;
    }

    .profile-field:last-child {
        margin-bottom: 0;
    }

    .profile-field label {
        display: block;
        margin-bottom: 8px;
        color: #425063;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .profile-field input,
    .profile-field select {
        width: 100%;
        height: 44px;
        padding: 0 14px;
        border: 1.5px solid #dfe4ee;
        border-radius: 6px;
        outline: 0;
        color: #2d313d;
        font-size: 14px;
        background: #fff;
        transition: all .2s ease;
    }

    .profile-field input:focus,
    .profile-field select:focus {
        border-color: #2495e7;
        box-shadow: 0 0 0 3px rgba(36, 149, 231, .10);
        background: #f9fcff;
    }

    .profile-feedback {
        margin-bottom: 16px;
        padding: 12px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        border-left: 4px solid;
    }

    .profile-feedback.success {
        color: #166534;
        background: #dcfce7;
        border-left-color: #22c55e;
    }

    .profile-feedback.error {
        color: #b91c1c;
        background: #fee2e2;
        border-left-color: #ef4444;
    }

    .profile-save {
        border: 0;
        background: linear-gradient(135deg, #2495e7 0%, #1a7bc7 100%);
        color: #fff;
        height: 40px;
        padding: 0 24px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s ease;
        box-shadow: 0 4px 12px rgba(36, 149, 231, .2);
    }

    .profile-save:hover {
        background: linear-gradient(135deg, #1a7bc7 0%, #0f5a9e 100%);
        box-shadow: 0 6px 16px rgba(36, 149, 231, .3);
        transform: translateY(-2px);
    }

    .profile-save:active {
        transform: translateY(0);
    }

    .users-table-wrap {
        overflow-x: auto;
    }

    .users-table {
        width: 100%;
        border-collapse: collapse;
    }

    .users-table thead th {
        padding: 14px 22px 12px;
        border-bottom: 2px solid #edf1f6;
        color: #5b6573;
        font-size: 13px;
        font-weight: 600;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .5px;
        background: #f9fafb;
    }

    .users-table tbody td {
        padding: 14px 22px;
        border-bottom: 1px solid #edf1f6;
        color: #2d313d;
        font-size: 14px;
        vertical-align: middle;
    }

    .users-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .users-table tbody tr {
        transition: background .2s ease;
    }

    .users-table tbody tr:hover td {
        background: #fbfcff;
    }

    .users-table th:nth-child(1),
    .users-table th:nth-child(4),
    .users-table th:nth-child(5),
    .users-table th:nth-child(6),
    .users-table td:nth-child(1),
    .users-table td:nth-child(4),
    .users-table td:nth-child(5),
    .users-table td:nth-child(6) {
        white-space: nowrap;
    }

    .users-table th:last-child,
    .users-table td:last-child {
        text-align: right;
    }

    .role-text {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 12px;
        text-transform: capitalize;
    }

    .role-text {
        color: #2495e7;
        background: #e8efff;
    }

    .user-actions {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .user-action-btn {
        width: 34px;
        height: 34px;
        border: 0;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 13px;
        cursor: pointer;
        transition: all .2s ease;
    }

    .user-action-btn.edit {
        background: #2495e7;
    }

    .user-action-btn.edit:hover {
        background: #1a7bc7;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(36, 149, 231, .3);
    }

    .user-action-btn.delete {
        background: #ef4444;
    }

    .user-action-btn.delete:hover {
        background: #dc2626;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(239, 68, 68, .3);
    }

    .users-empty {
        padding: 50px 22px;
        text-align: center;
        color: #9aa3b2;
        font-size: 14px;
    }

    .user-modal-overlay {
        position: fixed;
        inset: 0;
        display: none;
        align-items: center;
        justify-content: center;
        background: rgba(15, 42, 56, .55);
        z-index: 2100;
        padding: 18px;
        backdrop-filter: blur(3px);
    }

    .user-modal {
        width: min(520px, 100%);
        max-height: 90vh;
        overflow-y: auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 24px 60px rgba(15, 35, 52, .25);
        padding: 28px;
    }

    .user-modal-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 20px;
    }

    .user-modal-head h2 {
        margin: 0;
        color: #183247;
        font-size: 20px;
        font-weight: 700;
    }

    .user-modal-close {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 0;
        background: #f1f5fb;
        color: #526071;
        font-size: 18px;
        cursor: pointer;
        transition: all .2s ease;
    }

    .user-modal-close:hover {
        background: #e4ecf5;
        transform: rotate(90deg);
    }

    .user-modal-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .user-modal-foot {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 24px;
    }

    .user-modal-btn {
        border: 0;
        border-radius: 6px;
        height: 40px;
        padding: 0 18px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s ease;
    }

    .user-modal-btn.secondary {
        background: #eef1f5;
        color: #556274;
    }

    .user-modal-btn.secondary:hover {
        background: #e4ecf5;
    }

    .user-modal-btn.primary {
        background: linear-gradient(135deg, #2495e7 0%, #1a7bc7 100%);
        color: #fff;
        box-shadow: 0 4px 12px rgba(36, 149, 231, .2);
    }

    .user-modal-btn.primary:hover {
        background: linear-gradient(135deg, #1a7bc7 0%, #0f5a9e 100%);
        box-shadow: 0 6px 16px rgba(36, 149, 231, .3);
        transform: translateY(-2px);
    }

    @media (max-width: 991px) {
        .users-table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .profile-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 767px) {
        .profile-toolbar { align-items: stretch; }
        .profile-tabs { gap: 4px; }
        .profile-tab { padding: 10px 12px; font-size: 13px; }
        .profile-add-user { align-self: flex-start; width: 100%; }
        .profile-grid { grid-template-columns: 1fr; }

        .profile-card {
            padding: 22px 18px;
        }
    }
</style>
@endsection

@section('content')
    <div class="profile-page">
        @include('layouts.partials.admin_topbar', [
            'title' => 'Profile',
            'searchInputId' => 'profileSearch',
            'searchAriaLabel' => 'Search users',
        ])

        <div class="profile-toolbar">
            <div class="profile-tabs" role="tablist" aria-label="Profile sections">
                <button
                    type="button"
                    class="profile-tab {{ $activeTab === 'profile' ? 'is-active' : '' }}"
                    data-pane="profile"
                    role="tab"
                    aria-selected="{{ $activeTab === 'profile' ? 'true' : 'false' }}">
                    Profile
                </button>
                <button
                    type="button"
                    class="profile-tab {{ $activeTab === 'security' ? 'is-active' : '' }}"
                    data-pane="security"
                    role="tab"
                    aria-selected="{{ $activeTab === 'security' ? 'true' : 'false' }}">
                    Security
                </button>
                <button
                    type="button"
                    class="profile-tab {{ $activeTab === 'users' ? 'is-active' : '' }}"
                    data-pane="users"
                    role="tab"
                    aria-selected="{{ $activeTab === 'users' ? 'true' : 'false' }}">
                    Users
                </button>
            </div>

            <button
                type="button"
                class="profile-add-user{{ $activeTab !== 'users' ? ' d-none' : '' }}"
                id="addUserButton">
                <i class="fas fa-plus"></i> User
            </button>
        </div>

        <section class="profile-pane {{ $activeTab === 'profile' ? 'is-active' : '' }}" id="pane-profile">
            <div class="profile-card">
                <h2>Profile Information</h2>

                @if(session('success') && $activeTab === 'profile')
                    <div class="profile-feedback success">{{ session('success') }}</div>
                @endif

                @if($errors->any() && $activeTab === 'profile' && !$errors->has('current_password'))
                    <div class="profile-feedback error">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="active_tab" value="profile">

                    <div class="profile-grid">
                        <div class="profile-field">
                            <label for="profile-name">Full Name</label>
                            <input id="profile-name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="profile-field">
                            <label for="profile-email">Email Address</label>
                            <input id="profile-email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                    </div>

                    <button type="submit" class="profile-save">Save Changes</button>
                </form>
            </div>
        </section>

        <section class="profile-pane {{ $activeTab === 'security' ? 'is-active' : '' }}" id="pane-security">
            <div class="profile-card">
                <h2>Security</h2>

                @if(session('success') && $activeTab === 'security')
                    <div class="profile-feedback success">{{ session('success') }}</div>
                @endif

                @if($errors->any() && $activeTab === 'security')
                    <div class="profile-feedback error">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="active_tab" value="security">
                    <input type="hidden" name="name" value="{{ old('name', $user->name) }}">
                    <input type="hidden" name="email" value="{{ old('email', $user->email) }}">

                    <div class="profile-grid">
                        <div class="profile-field">
                            <label for="current-password">Current Password</label>
                            <input id="current-password" type="password" name="current_password">
                        </div>
                        <div class="profile-field">
                            <label for="new-password">New Password</label>
                            <input id="new-password" type="password" name="new_password">
                        </div>
                        <div class="profile-field">
                            <label for="confirm-password">Confirm New Password</label>
                            <input id="confirm-password" type="password" name="new_password_confirmation">
                        </div>
                    </div>

                    <button type="submit" class="profile-save">Update Password</button>
                </form>
            </div>
        </section>

        <section class="profile-pane {{ $activeTab === 'users' ? 'is-active' : '' }}" id="pane-users">
            <div class="users-card">
                @if($users->count())
                    <div class="users-table-wrap">
                        <table class="users-table" id="usersTable">
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
                                @foreach($users as $index => $listedUser)
                                    <tr data-user-id="{{ $listedUser->id }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $listedUser->name }}</td>
                                        <td>{{ $listedUser->email }}</td>
                                        <td>{{ $listedUser->phone_number ?: 'N/A' }}</td>
                                        <td><span class="role-text">{{ ucfirst($listedUser->role ?: 'client') }}</span></td>
                                        <td>
                                            <div class="user-actions">
                                                <button type="button" class="user-action-btn edit" title="Edit user">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                <button type="button" class="user-action-btn delete" title="Delete user">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="users-empty">No users found.</div>
                @endif
            </div>
        </section>
    </div>

    <div class="user-modal-overlay" id="addUserModal">
        <div class="user-modal">
            <div class="user-modal-head">
                <h2>Add User</h2>
                <button type="button" class="user-modal-close" id="closeAddUserModal">&times;</button>
            </div>

            <form method="POST" action="{{ route('profile.users.store') }}" id="addUserForm">
                @csrf
                <div class="user-modal-grid">
                    <div class="profile-field">
                        <label for="new-user-name">Full Name</label>
                        <input id="new-user-name" name="name" type="text" placeholder="Full name" required>
                    </div>
                    <div class="profile-field">
                        <label for="new-user-email">Email Address</label>
                        <input id="new-user-email" name="email" type="email" placeholder="Email address" required>
                    </div>
                    <div class="profile-field">
                        <label for="new-user-phone">Phone Number</label>
                        <input id="new-user-phone" name="phone" type="text" placeholder="Phone number">
                    </div>
                    <div class="profile-field">
                        <label for="new-user-role">Role</label>
                        <select id="new-user-role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                            <option value="client">Client</option>
                        </select>
                    </div>
                    <div class="profile-field">
                        <label for="new-user-password">Password</label>
                        <input id="new-user-password" name="password" type="password" placeholder="Password" required minlength="8">
                    </div>
                </div>

                <div class="user-modal-foot">
                    <button type="button" class="user-modal-btn secondary" id="cancelAddUserModal">Cancel</button>
                    <button type="submit" class="user-modal-btn primary">Create User</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var tabs = Array.from(document.querySelectorAll('.profile-tab'));
    var panes = Array.from(document.querySelectorAll('.profile-pane'));
    var addUserButton = document.getElementById('addUserButton');
    var profileSearch = document.getElementById('profileSearch');
    var addUserModal = document.getElementById('addUserModal');
    var closeAddUserModal = document.getElementById('closeAddUserModal');
    var cancelAddUserModal = document.getElementById('cancelAddUserModal');

    function activatePane(name) {
        tabs.forEach(function (tab) {
            var active = tab.dataset.pane === name;
            tab.classList.toggle('is-active', active);
            tab.setAttribute('aria-selected', active ? 'true' : 'false');
        });

        panes.forEach(function (pane) {
            pane.classList.toggle('is-active', pane.id === 'pane-' + name);
        });

        addUserButton.classList.toggle('d-none', name !== 'users');
        window.location.hash = name;
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            activatePane(tab.dataset.pane);
        });
    });

    if (window.location.hash) {
        var hashTarget = window.location.hash.replace('#', '');
        if (['profile', 'security', 'users'].indexOf(hashTarget) !== -1) {
            activatePane(hashTarget);
        }
    }

    if (profileSearch) {
        profileSearch.addEventListener('input', function () {
            var query = profileSearch.value.trim().toLowerCase();
            var rows = document.querySelectorAll('#usersTable tbody tr');

            rows.forEach(function (row) {
                var text = row.textContent.toLowerCase();
                row.style.display = text.indexOf(query) === -1 ? 'none' : '';
            });
        });
    }

    addUserButton.addEventListener('click', function () {
        addUserModal.style.display = 'flex';
        document.getElementById('new-user-name').focus();
    });

    closeAddUserModal.addEventListener('click', function () {
        addUserModal.style.display = 'none';
        document.getElementById('addUserForm').reset();
    });

    cancelAddUserModal.addEventListener('click', function () {
        addUserModal.style.display = 'none';
        document.getElementById('addUserForm').reset();
    });

    addUserModal.addEventListener('click', function (event) {
        if (event.target === addUserModal) {
            addUserModal.style.display = 'none';
            document.getElementById('addUserForm').reset();
        }
    });

    // Delete user with confirmation
    var deleteButtons = document.querySelectorAll('.user-action-btn.delete');
    deleteButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var row = btn.closest('tr');
            var userName = row.querySelector('td:nth-child(2)').textContent;
            
            if (confirm('Are you sure you want to delete ' + userName + '? This action cannot be undone.')) {
                var userId = row.getAttribute('data-user-id');
                if (userId) {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/profile/users/' + userId;
                    form.innerHTML = '@csrf @method("DELETE")';
                    document.body.appendChild(form);
                    form.submit();
                }
            }
        });
    });

    // Escape key to close modal
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && addUserModal.style.display === 'flex') {
            addUserModal.style.display = 'none';
            document.getElementById('addUserForm').reset();
        }
    });
});
</script>
@endsection

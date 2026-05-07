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
        padding-bottom: 2px;
        border-bottom: 1px solid #dfe4ee;
    }

    .profile-tabs {
        display: inline-flex;
        align-items: center;
        gap: 36px;
        overflow-x: auto;
        max-width: 100%;
    }

    .profile-tab {
        position: relative;
        border: 0;
        background: transparent;
        padding: 0 0 12px;
        color: #313947;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        white-space: nowrap;
    }

    .profile-tab::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: -1px;
        height: 3px;
        border-radius: 999px;
        background: transparent;
        transition: background .18s ease;
    }

    .profile-tab.is-active::after {
        background: #2495e7;
    }

    .profile-tab:not(.is-active) {
        color: #3d4554;
        opacity: .92;
    }

    .profile-add-user {
        border: 0;
        background: #122c3b;
        color: #fff;
        height: 34px;
        padding: 0 16px;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
        box-shadow: 0 10px 20px rgba(18, 44, 59, .12);
    }

    .profile-add-user:hover {
        background: #0f2431;
        color: #fff;
        text-decoration: none;
    }

    .profile-pane {
        display: none;
    }

    .profile-pane.is-active {
        display: block;
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
        margin: 0 0 18px;
        color: #1f2937;
        font-size: 18px;
        font-weight: 700;
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
        margin-bottom: 7px;
        color: #425063;
        font-size: 13px;
        font-weight: 600;
    }

    .profile-field input,
    .profile-field select {
        width: 100%;
        height: 44px;
        padding: 0 14px;
        border: 1px solid #dfe4ee;
        border-radius: 6px;
        outline: 0;
        color: #2d313d;
        font-size: 14px;
        background: #fff;
    }

    .profile-field input:focus,
    .profile-field select:focus {
        border-color: #2495e7;
        box-shadow: 0 0 0 3px rgba(36, 149, 231, .10);
    }

    .profile-feedback {
        margin-bottom: 16px;
        padding: 11px 13px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
    }

    .profile-feedback.success {
        color: #166534;
        background: #dcfce7;
    }

    .profile-feedback.error {
        color: #b91c1c;
        background: #fee2e2;
    }

    .profile-save {
        border: 0;
        background: #122c3b;
        color: #fff;
        height: 40px;
        padding: 0 18px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
    }

    .profile-save:hover {
        background: #0f2431;
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
        border-bottom: 1px solid #edf1f6;
        color: #5b6573;
        font-size: 13px;
        font-weight: 500;
        text-align: left;
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
        color: #2d313d;
        font-weight: 500;
    }

    .user-actions {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .user-action-btn {
        width: 34px;
        height: 30px;
        border: 0;
        border-radius: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 13px;
        cursor: pointer;
    }

    .user-action-btn.edit {
        background: #122c3b;
    }

    .user-action-btn.delete {
        background: #ff2a2a;
    }

    .users-empty {
        padding: 36px 22px;
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
        background: rgba(15, 42, 56, .45);
        z-index: 2100;
        padding: 18px;
    }

    .user-modal {
        width: min(520px, 100%);
        max-height: 90vh;
        overflow-y: auto;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 24px 60px rgba(15, 35, 52, .22);
        padding: 22px;
    }

    .user-modal-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 16px;
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
        margin-top: 20px;
    }

    .user-modal-btn {
        border: 0;
        border-radius: 8px;
        height: 40px;
        padding: 0 18px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    .user-modal-btn.secondary {
        background: #eef1f5;
        color: #556274;
    }

    .user-modal-btn.primary {
        background: #122c3b;
        color: #fff;
    }

    @media (max-width: 991px) {
        .users-table-wrap {
            overflow-x: auto;
        }

        .users-table {
            min-width: 900px;
        }
    }

    @media (max-width: 767px) {
        .profile-toolbar {
            align-items: stretch;
        }

        .profile-tabs {
            gap: 24px;
        }

        .profile-add-user {
            align-self: flex-start;
        }

        .profile-grid {
            grid-template-columns: 1fr;
        }

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
                class="profile-add-user"
                id="addUserButton"
                style="{{ $activeTab === 'users' ? '' : 'display:none;' }}">
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
                                    <tr>
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

            <div class="user-modal-grid">
                <div class="profile-field">
                    <label for="new-user-name">Full Name</label>
                    <input id="new-user-name" type="text" placeholder="Full name">
                </div>
                <div class="profile-field">
                    <label for="new-user-email">Email Address</label>
                    <input id="new-user-email" type="email" placeholder="Email address">
                </div>
                <div class="profile-field">
                    <label for="new-user-phone">Phone Number</label>
                    <input id="new-user-phone" type="text" placeholder="Phone number">
                </div>
                <div class="profile-field">
                    <label for="new-user-role">Role</label>
                    <select id="new-user-role">
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                        <option value="client">Client</option>
                    </select>
                </div>
                <div class="profile-field">
                    <label for="new-user-password">Password</label>
                    <input id="new-user-password" type="password" placeholder="Password">
                </div>
            </div>

            <div class="user-modal-foot">
                <button type="button" class="user-modal-btn secondary" id="cancelAddUserModal">Cancel</button>
                <button type="button" class="user-modal-btn primary">Create User</button>
            </div>
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

        addUserButton.style.display = name === 'users' ? 'inline-flex' : 'none';
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
                row.style.display = row.textContent.toLowerCase().indexOf(query) === -1 ? 'none' : '';
            });
        });
    }

    addUserButton.addEventListener('click', function () {
        addUserModal.style.display = 'flex';
    });

    closeAddUserModal.addEventListener('click', function () {
        addUserModal.style.display = 'none';
    });

    cancelAddUserModal.addEventListener('click', function () {
        addUserModal.style.display = 'none';
    });

    addUserModal.addEventListener('click', function (event) {
        if (event.target === addUserModal) {
            addUserModal.style.display = 'none';
        }
    });
});
</script>
@endsection

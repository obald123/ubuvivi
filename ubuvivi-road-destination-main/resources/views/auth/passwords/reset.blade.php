@extends('layouts.auth_app')
@section('title', 'Set New Password')

@section('content')

    @if ($errors->any())
        <div class="auth-errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <p class="auth-hint">
        Choose a strong new password for your account.
    </p>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="auth-field">
            <div class="field-icon"><i class="far fa-envelope"></i></div>
            <input type="email" name="email" placeholder="Your email address"
                value="{{ old('email', $email ?? '') }}" required autofocus>
        </div>

        <div class="auth-field" id="field-password">
            <div class="field-icon"><i class="far fa-lock"></i></div>
            <input type="password" id="password" name="password"
                placeholder="New password" required>
            <button type="button" class="toggle-pw" onclick="togglePw('password','icon-pw')">
                <i id="icon-pw" class="far fa-eye"></i>
            </button>
        </div>
        <p class="auth-hint" style="font-size:11px;margin-top:-8px;margin-bottom:14px;">
            At least 8 characters with uppercase, lowercase, numbers and symbols.
        </p>

        <div class="auth-field">
            <div class="field-icon"><i class="far fa-lock"></i></div>
            <input type="password" id="password_confirmation" name="password_confirmation"
                placeholder="Confirm new password" required>
            <button type="button" class="toggle-pw" onclick="togglePw('password_confirmation','icon-pw2')">
                <i id="icon-pw2" class="far fa-eye"></i>
            </button>
        </div>

        <button type="submit" class="auth-submit">Set New Password</button>
    </form>

    <p class="auth-footer-link">
        Remembered your password? <a href="{{ route('login') }}">Sign In</a>
    </p>

@endsection

@push('styles')
<style>
    .auth-hint {
        color: rgba(255,255,255,.72);
        font-size: 13px;
        line-height: 1.6;
        margin-bottom: 20px;
        text-align: center;
    }
    .toggle-pw {
        background: none;
        border: none;
        color: rgba(255,255,255,.65);
        padding: 0 14px;
        cursor: pointer;
        font-size: 15px;
        line-height: 1;
        transition: color .2s;
    }
    .toggle-pw:hover { color: #fff; }
</style>
@endpush

@push('scripts')
<script>
function togglePw(fieldId, iconId) {
    var f = document.getElementById(fieldId);
    var i = document.getElementById(iconId);
    if (f.type === 'password') {
        f.type = 'text';
        i.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        f.type = 'password';
        i.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>
@endpush

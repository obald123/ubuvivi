@extends('layouts.auth_app')
@section('title', 'Reset Password')

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

    <form method="POST" action="{{ url('/password/reset') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="auth-field">
            <div class="field-icon"><i class="far fa-envelope"></i></div>
            <input type="email" name="email" placeholder="Email address"
                value="{{ old('email') }}" required autofocus>
        </div>

        <div class="auth-field">
            <div class="field-icon"><i class="far fa-lock"></i></div>
            <input type="password" name="password" placeholder="New password" required>
        </div>

        <div class="auth-field">
            <div class="field-icon"><i class="far fa-lock"></i></div>
            <input type="password" name="password_confirmation" placeholder="Confirm new password" required>
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
</style>
@endpush

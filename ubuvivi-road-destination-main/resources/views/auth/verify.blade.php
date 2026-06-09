@extends('layouts.auth_app')
@section('title', 'Verify Email')

@section('content')

    @if (session('resent'))
        <div class="auth-status">
            <i class="far fa-check-circle"></i>
            A fresh verification link has been sent to your email address.
        </div>
    @endif

    <p class="auth-hint">
        Before proceeding, please check your email for a verification link.
        If you did not receive the email, click the button below to request another.
    </p>

    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="auth-submit">Resend Verification Email</button>
    </form>

    <p class="auth-footer-link">
        <a href="{{ route('login') }}">Back to Sign In</a>
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
    .auth-status {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(22,163,74,.25);
        border: 1px solid rgba(22,163,74,.5);
        border-radius: 8px;
        padding: 11px 14px;
        margin-bottom: 16px;
        color: #86efac;
        font-size: 13px;
        text-align: left;
    }
    .auth-status i { font-size: 15px; flex-shrink: 0; }
</style>
@endpush

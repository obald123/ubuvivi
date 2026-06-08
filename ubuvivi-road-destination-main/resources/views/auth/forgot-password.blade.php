@extends('layouts.auth_app')

@section('title', 'Forgot Password')

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

    @if (session('status'))
        <div class="auth-status">
            <i class="far fa-check-circle"></i>
            {{ session('status') }}
        </div>
    @endif

    <p class="auth-hint">
        Enter your email address and we'll send you a link to reset your password.
    </p>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="auth-field">
            <div class="field-icon"><i class="far fa-envelope"></i></div>
            <input type="email" name="email" placeholder="Enter your email address"
                value="{{ old('email') }}" required autofocus>
        </div>

        <button type="submit" class="auth-submit">Send Reset Link</button>
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


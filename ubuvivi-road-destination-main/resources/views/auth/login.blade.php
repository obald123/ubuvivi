@extends('layouts.auth_app')

@section('title', 'Sign In')

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

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="auth-field">
            <div class="field-icon"><i class="far fa-envelope"></i></div>
            <input type="email" name="email" placeholder="Enter your email address"
                value="{{ Cookie::get('email') ?? old('email') }}" required autofocus>
        </div>

        {{-- Password --}}
        <div class="auth-field">
            <div class="field-icon"><i class="far fa-lock"></i></div>
            <input type="password" name="password" placeholder="Enter your password"
                value="{{ Cookie::get('password') ?? null }}" required>
        </div>

        {{-- Remember + Forgot --}}
        <div class="auth-row">
            <label>
                <input type="checkbox" name="remember" {{ Cookie::get('remember') ? 'checked' : '' }}>
                Remember Me
            </label>
            <a href="{{ route('password.request') }}">Forgot Password?</a>
        </div>

        <button type="submit" class="auth-submit">Sign In</button>
    </form>

    <p class="auth-footer-link">
        Don't have an account? <a href="{{ route('register') }}">Register</a>
    </p>

@endsection

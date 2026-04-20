@extends('layouts.auth_app')

@section('title', 'Register')

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

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Full Name --}}
        <div class="auth-field">
            <div class="field-icon"><i class="far fa-user"></i></div>
            <input type="text" name="name" placeholder="Enter your Full names"
                value="{{ old('name') }}" required autofocus>
        </div>

        {{-- Email --}}
        <div class="auth-field">
            <div class="field-icon"><i class="far fa-envelope"></i></div>
            <input type="email" name="email" placeholder="Enter your email address"
                value="{{ old('email') }}" required>
        </div>

        {{-- Phone --}}
        <div class="auth-field">
            <div class="field-icon"><i class="far fa-phone"></i></div>
            <input type="tel" name="phone_number" placeholder="Enter your phone number"
                value="{{ old('phone_number') }}" required>
        </div>

        {{-- Password --}}
        <div class="auth-field">
            <div class="field-icon"><i class="far fa-lock"></i></div>
            <input type="password" name="password" placeholder="Enter your password" required>
        </div>

        {{-- Confirm Password --}}
        <div class="auth-field">
            <div class="field-icon"><i class="far fa-lock"></i></div>
            <input type="password" name="password_confirmation" placeholder="Re-enter your password" required>
        </div>

        {{-- Terms --}}
        <div class="auth-row" style="justify-content: flex-start;">
            <label>
                <input type="checkbox" required>
                I agree to Terms &amp; Conditions
            </label>
        </div>

        <button type="submit" class="auth-submit">Sign Up</button>
    </form>

    <p class="auth-footer-link">
        Already have an account? <a href="{{ route('login') }}">Sign in</a>
    </p>

@endsection

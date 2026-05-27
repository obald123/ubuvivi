@extends('layouts.auth_app')
@section('title')
    Set New Password - Ubuvivi Tours
@endsection
@section('content')
    <div style="max-width: 450px; margin: 0 auto;">
        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <!-- Header -->
            <div style="background: linear-gradient(135deg, #6c5ce7 0%, #5f3dc4 100%); padding: 30px 20px; text-align: center; color: white;">
                <i class="fas fa-key" style="font-size: 32px; margin-bottom: 15px; display: block;"></i>
                <h3 style="margin: 0; font-weight: bold;">Create New Password</h3>
                <p style="margin: 8px 0 0 0; opacity: 0.9; font-size: 14px;">Enter your new password below</p>
            </div>

            <div class="card-body" style="padding: 30px;">
                <!-- Error Messages -->
                @if ($errors->any())
                    <div style="background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 6px; padding: 12px 15px; margin-bottom: 20px;">
                        <div style="color: #721c24; font-weight: 600; margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-exclamation-triangle"></i>
                            Please fix the following errors:
                        </div>
                        <ul style="margin: 0; padding-left: 20px; color: #721c24;">
                            @foreach ($errors->all() as $error)
                                <li style="margin: 4px 0; font-size: 13px;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ url('/password/reset') }}" novalidate>
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email Field -->
                    <div class="form-group mb-3">
                        <label for="email" style="font-weight: 600; color: #333; margin-bottom: 8px; display: block;">
                            Email Address
                        </label>
                        <input
                            id="email"
                            type="email"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Your email address"
                            tabindex="1"
                            autofocus
                            style="padding: 10px 12px; border: 1px solid #dee2e6; border-radius: 6px; font-size: 15px;"
                        >
                        @if ($errors->has('email'))
                            <div style="color: #dc3545; font-size: 13px; margin-top: 6px;">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <!-- Password Field -->
                    <div class="form-group mb-3">
                        <label for="password" style="font-weight: 600; color: #333; margin-bottom: 8px; display: block;">
                            New Password
                        </label>
                        <div style="position: relative;">
                            <input
                                id="password"
                                type="password"
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                name="password"
                                placeholder="Enter a strong password"
                                tabindex="2"
                                style="padding: 10px 12px; border: 1px solid #dee2e6; border-radius: 6px; font-size: 15px; padding-right: 40px;"
                            >
                            <span onclick="togglePassword('password')" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #999;">
                                <i class="fas fa-eye" id="password-icon"></i>
                            </span>
                        </div>
                        <small style="color: #999; margin-top: 6px; display: block;">
                            At least 8 characters, with uppercase, lowercase, numbers and symbols
                        </small>
                        @if ($errors->has('password'))
                            <div style="color: #dc3545; font-size: 13px; margin-top: 6px;">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="form-group mb-4">
                        <label for="password_confirmation" style="font-weight: 600; color: #333; margin-bottom: 8px; display: block;">
                            Confirm Password
                        </label>
                        <div style="position: relative;">
                            <input
                                id="password_confirmation"
                                type="password"
                                class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                name="password_confirmation"
                                placeholder="Re-enter your password"
                                tabindex="3"
                                style="padding: 10px 12px; border: 1px solid #dee2e6; border-radius: 6px; font-size: 15px; padding-right: 40px;"
                            >
                            <span onclick="togglePassword('password_confirmation')" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #999;">
                                <i class="fas fa-eye" id="password_confirmation-icon"></i>
                            </span>
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <div style="color: #dc3545; font-size: 13px; margin-top: 6px;">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="btn btn-block"
                        tabindex="4"
                        style="background: linear-gradient(135deg, #6c5ce7 0%, #5f3dc4 100%); color: white; border: none; padding: 11px 15px; border-radius: 6px; font-weight: 600; font-size: 15px; transition: all 0.3s ease; cursor: pointer;"
                        onmouseover="this.style.opacity='0.9'"
                        onmouseout="this.style.opacity='1'"
                    >
                        <i class="fas fa-lock" style="margin-right: 8px;"></i>
                        Set New Password
                    </button>
                </form>

                <!-- Info Box -->
                <div style="background: #f0f6ff; border-left: 4px solid #6c5ce7; padding: 12px 15px; border-radius: 4px; margin-top: 20px; font-size: 13px; color: #555;">
                    <i class="fas fa-shield-alt" style="color: #6c5ce7; margin-right: 8px;"></i>
                    Your password is encrypted and secure. Use a strong, unique password.
                </div>
            </div>
        </div>

        <!-- Back to Login Link -->
        <div style="text-align: center; margin-top: 20px;">
            <p style="color: #666; margin: 0; font-size: 14px;">
                Changed your mind?
                <a href="{{ route('login') }}" style="color: #6c5ce7; text-decoration: none; font-weight: 600; transition: opacity 0.2s;">
                    Sign In
                </a>
            </p>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');

            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection

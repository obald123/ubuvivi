@extends('layouts.auth_app')
@section('title')
    Reset Your Password - Ubuvivi Tours
@endsection
@section('content')
    <div style="max-width: 450px; margin: 0 auto;">
        <div class="card border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <!-- Header -->
            <div style="background: linear-gradient(135deg, #6c5ce7 0%, #5f3dc4 100%); padding: 30px 20px; text-align: center; color: white;">
                <i class="fas fa-lock" style="font-size: 32px; margin-bottom: 15px; display: block;"></i>
                <h3 style="margin: 0; font-weight: bold;">Reset Your Password</h3>
                <p style="margin: 8px 0 0 0; opacity: 0.9; font-size: 14px;">Enter your email to receive a password reset link</p>
            </div>

            <div class="card-body" style="padding: 30px;">
                <!-- Status Message -->
                @if (session('status'))
                    <div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 12px 15px; border-radius: 6px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('password.email') }}" novalidate>
                    @csrf

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
                            placeholder="Enter your email address"
                            tabindex="1"
                            autofocus
                            required
                            style="padding: 10px 12px; border: 1px solid #dee2e6; border-radius: 6px; font-size: 15px;"
                        >
                        @if ($errors->has('email'))
                            <div style="color: #dc3545; font-size: 13px; margin-top: 6px; display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <!-- Info Box -->
                    <div style="background: #f0f6ff; border-left: 4px solid #6c5ce7; padding: 12px 15px; border-radius: 4px; margin-bottom: 20px; font-size: 13px; color: #555;">
                        <i class="fas fa-info-circle" style="color: #6c5ce7; margin-right: 8px;"></i>
                        We'll send you an email with a link to reset your password.
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
                        <i class="fas fa-paper-plane" style="margin-right: 8px;"></i>
                        Send Reset Link
                    </button>
                </form>

                <!-- Help Text -->
                <p style="text-align: center; color: #999; font-size: 12px; margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
                    Check your spam folder if you don't see the email within a few minutes.
                </p>
            </div>
        </div>

        <!-- Back to Login Link -->
        <div style="text-align: center; margin-top: 20px;">
            <p style="color: #666; margin: 0; font-size: 14px;">
                Remember your password?
                <a href="{{ route('login') }}" style="color: #6c5ce7; text-decoration: none; font-weight: 600; transition: opacity 0.2s;">
                    Sign In
                </a>
            </p>
        </div>
    </div>
@endsection

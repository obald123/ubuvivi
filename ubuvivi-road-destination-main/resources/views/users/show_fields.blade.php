<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Phone Number Field -->
<div class="form-group">
    {!! Form::label('phone_number', 'Phone Number:') !!}
    <p>{{ $user->phone_number }}</p>
</div>

<!-- Role Field -->
<div class="form-group">
    {!! Form::label('role', 'Role:') !!}
    <p>{{ $user->role }}</p>
</div>

<!-- Email Verified At Field -->
<div class="form-group">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    <p>{{ $user->email_verified_at }}</p>
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    <p>{{ $user->password }}</p>
</div>

<!-- Two Factor Secret Field -->
<div class="form-group">
    {!! Form::label('two_factor_secret', 'Two Factor Secret:') !!}
    <p>{{ $user->two_factor_secret }}</p>
</div>

<!-- Two Factor Recovery Codes Field -->
<div class="form-group">
    {!! Form::label('two_factor_recovery_codes', 'Two Factor Recovery Codes:') !!}
    <p>{{ $user->two_factor_recovery_codes }}</p>
</div>

<!-- Remember Token Field -->
<div class="form-group">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    <p>{{ $user->remember_token }}</p>
</div>


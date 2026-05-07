@extends('layouts.guest')

@section('title')
    {{ $tour->title }} | Quick Booking - Ubuvivi Tours
@endsection

@section('body-class', 'hero-page')

@php
    $heroImage = is_array($tour->images) && !empty($tour->images)
        ? $tour->images[0]
        : asset('assets/images/backgrounds/bg_11.jpg');

    $startTime = old('preferred_time', '00:00');
    $startMeridiem = old('preferred_meridiem', 'AM');
    $untilTime = old('available_until_time', '00:00');
    $untilMeridiem = old('available_until_meridiem', 'AM');
@endphp

@section('meta')
    <meta name="description" content="Quickly book {{ $tour->title }} with Ubuvivi Tours.">
    <meta name="keywords" content="ubuvivi, {{ $tour->title }}, quick booking, Rwanda tours">
@endsection

@section('css')
<style>
    .quick-booking-hero {
        position: relative;
        min-height: 340px;
        background-image: url('{{ $heroImage }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .quick-booking-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(11, 31, 46, .18) 0%, rgba(11, 31, 46, .14) 40%, rgba(11, 31, 46, .32) 100%);
    }

    .quick-booking-shell {
        position: relative;
        z-index: 2;
        margin-top: -34px;
        padding-bottom: 48px;
    }

    .quick-booking-card {
        background: #fff;
        border-radius: 30px 30px 0 0;
        box-shadow: 0 22px 50px rgba(14, 42, 56, .10);
        padding: 20px 0 0;
        overflow: hidden;
    }

    .quick-booking-head {
        text-align: center;
        padding: 0 26px 18px;
    }

    .quick-booking-accent {
        width: 48px;
        height: 6px;
        border-radius: 999px;
        background: #ff6a2a;
        margin: 0 auto 12px;
    }

    .quick-booking-head h1 {
        margin: 0;
        color: #171f2a;
        font-size: clamp(28px, 4vw, 40px);
        font-weight: 700;
        font-family: 'Poppins', sans-serif !important;
    }

    .quick-booking-form {
        padding: 0 28px 30px;
    }

    .quick-booking-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px 34px;
    }

    .quick-booking-field {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .quick-booking-field.full {
        grid-column: 1 / -1;
    }

    .quick-booking-field label {
        margin: 0;
        color: #171f2a;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif !important;
    }

    .quick-booking-input,
    .quick-booking-textarea,
    .quick-booking-time,
    .quick-booking-select {
        width: 100%;
        border: 1px solid #bfc7d4;
        border-radius: 2px;
        background: #fff;
        color: #1f2937;
        font-size: 15px;
        outline: 0;
        box-shadow: none;
    }

    .quick-booking-input,
    .quick-booking-time,
    .quick-booking-select {
        height: 42px;
        padding: 0 12px;
    }

    .quick-booking-textarea {
        min-height: 128px;
        padding: 12px;
        resize: vertical;
    }

    .quick-booking-input:focus,
    .quick-booking-textarea:focus,
    .quick-booking-time:focus,
    .quick-booking-select:focus {
        border-color: #ff6a2a;
        box-shadow: 0 0 0 3px rgba(255, 97, 36, .10);
    }

    .quick-booking-input[readonly] {
        background: #fff;
        color: #374151;
    }

    .quick-booking-datetime {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 92px 84px;
        gap: 14px;
    }

    .quick-booking-actions {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        margin-top: 18px;
    }

    .quick-booking-submit {
        border: 0;
        background: #ff6124;
        color: #fff;
        min-width: 178px;
        height: 46px;
        padding: 0 24px;
        border-radius: 999px;
        font-size: 16px;
        font-weight: 600;
        transition: background .18s ease, transform .18s ease;
    }

    .quick-booking-submit:hover {
        background: #e35620;
        transform: translateY(-1px);
    }

    .quick-booking-note {
        margin: 0;
        color: #6b7280;
        font-size: 13px;
        text-align: center;
    }

    .quick-booking-alert {
        margin-bottom: 18px;
        padding: 12px 14px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
    }

    .quick-booking-alert.error {
        background: #fee2e2;
        color: #b91c1c;
    }

    .quick-booking-alert.success {
        background: #dcfce7;
        color: #166534;
    }

    @media (max-width: 991px) {
        .quick-booking-grid {
            grid-template-columns: 1fr;
        }

        .quick-booking-form {
            padding: 0 22px 28px;
        }
    }

    @media (max-width: 767px) {
        .quick-booking-hero {
            min-height: 270px;
        }

        .quick-booking-card {
            border-radius: 24px 24px 0 0;
        }

        .quick-booking-form {
            padding: 0 16px 24px;
        }

        .quick-booking-head {
            padding: 0 16px 16px;
        }

        .quick-booking-datetime {
            grid-template-columns: 1fr;
            gap: 10px;
        }
    }
</style>
@endsection

@section('content')
    <section class="quick-booking-hero"></section>

    <section class="quick-booking-shell">
        <div class="container">
            <div class="quick-booking-card">
                <div class="quick-booking-head">
                    <div class="quick-booking-accent"></div>
                    <h1>Quick Booking</h1>
                </div>

                <div class="quick-booking-form">
                    @if ($errors->any())
                        <div class="quick-booking-alert error">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    @include('flash::message')

                    {!! Form::open(['route' => ['tour.book', $tour->id]]) !!}
                        <div class="quick-booking-grid">
                            <div class="quick-booking-field">
                                <label for="names">Full Name</label>
                                {!! Form::text('names', isset($names) ? $names : null, [
                                    'id' => 'names',
                                    'class' => 'quick-booking-input',
                                    'required' => true,
                                    'maxlength' => 255,
                                ]) !!}
                            </div>

                            <div class="quick-booking-field">
                                <label for="email">Email</label>
                                {!! Form::email('email', isset($email) ? $email : null, [
                                    'id' => 'email',
                                    'class' => 'quick-booking-input',
                                    'required' => true,
                                    'maxlength' => 255,
                                ]) !!}
                            </div>

                            <div class="quick-booking-field">
                                <label for="phone_number">Phone number</label>
                                {!! Form::tel('phone_number', isset($phone_number) ? $phone_number : null, [
                                    'id' => 'phone_number',
                                    'class' => 'quick-booking-input',
                                    'required' => true,
                                    'maxlength' => 13,
                                ]) !!}
                            </div>

                            <div class="quick-booking-field">
                                <label for="number_of_people">Number of people</label>
                                {!! Form::text('number_of_people', isset($number_of_people) ? $number_of_people : null, [
                                    'id' => 'number_of_people',
                                    'class' => 'quick-booking-input',
                                    'maxlength' => 255,
                                ]) !!}
                            </div>

                            <div class="quick-booking-field">
                                <label for="service_display">Service</label>
                                <input id="service_display" type="text" class="quick-booking-input" value="Tour & Travel" readonly>
                            </div>

                            <div class="quick-booking-field">
                                <label for="tour_package_display">Tour Package</label>
                                <input id="tour_package_display" type="text" class="quick-booking-input" value="{{ $tour->title }}" readonly>
                            </div>

                            <div class="quick-booking-field">
                                <label>Start Date &amp; Time</label>
                                <div class="quick-booking-datetime">
                                    {!! Form::date('date', isset($date) ? $date : null, [
                                        'id' => 'dateField',
                                        'class' => 'quick-booking-input',
                                    ]) !!}

                                    <input
                                        type="text"
                                        name="preferred_time"
                                        class="quick-booking-time"
                                        maxlength="10"
                                        placeholder="00:00"
                                        value="{{ $startTime }}">

                                    <select name="preferred_meridiem" class="quick-booking-select">
                                        <option value="AM" {{ $startMeridiem === 'AM' ? 'selected' : '' }}>AM</option>
                                        <option value="PM" {{ $startMeridiem === 'PM' ? 'selected' : '' }}>PM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="quick-booking-field">
                                <label>Available Until</label>
                                <div class="quick-booking-datetime">
                                    {!! Form::date('available_until_date', old('available_until_date'), [
                                        'class' => 'quick-booking-input',
                                    ]) !!}

                                    <input
                                        type="text"
                                        name="available_until_time"
                                        class="quick-booking-time"
                                        maxlength="10"
                                        placeholder="00:00"
                                        value="{{ $untilTime }}">

                                    <select name="available_until_meridiem" class="quick-booking-select">
                                        <option value="AM" {{ $untilMeridiem === 'AM' ? 'selected' : '' }}>AM</option>
                                        <option value="PM" {{ $untilMeridiem === 'PM' ? 'selected' : '' }}>PM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="quick-booking-field full">
                                <label for="message">Special Requests</label>
                                {!! Form::textarea('message', isset($message) ? $message : null, [
                                    'id' => 'message',
                                    'class' => 'quick-booking-textarea',
                                    'rows' => 5,
                                    'maxlength' => 5000,
                                ]) !!}
                            </div>
                        </div>

                        <div class="quick-booking-actions">
                            <button type="submit" class="quick-booking-submit">Submit Request</button>
                            <p class="quick-booking-note">Our team will contact you shortly to confirm your booking.</p>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var dateField = document.getElementById('dateField');

    if (dateField && !dateField.value) {
        var now = new Date();
        var month = String(now.getMonth() + 1).padStart(2, '0');
        var day = String(now.getDate()).padStart(2, '0');
        dateField.value = now.getFullYear() + '-' + month + '-' + day;
    }
});
</script>
@endsection

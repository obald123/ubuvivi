@extends('layouts.guest')

@section('title')
    {{ $vehicle->brand->name ?? 'Vehicle' }} {{ $vehicle->model->name ?? '' }} | Book This Car - Ubuvivi Tours & Travels
@endsection

@section('meta')
    <meta name="description" content="Book {{ $vehicle->brand->name ?? '' }} {{ $vehicle->model->name ?? '' }} {{ $vehicle->production_year ?? '' }} - Ubuvivi Tours & Travels Rwanda">
@endsection

@section('css')
<style>
    /* ── Search bar ── */
    .search-bar-wrap {
        position: relative;
        z-index: 10;
        width: 90%;
        max-width: 860px;
        margin: 0 auto;
        padding-top: 24px;
    }
    .search-bar {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 40px rgba(0,0,0,.18);
        padding: 20px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .search-bar .filter-group {
        flex: 1 1 160px;
        min-width: 160px;
        display: flex;
    }
    .search-bar .filter-select {
        width: 100%;
        height: 48px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        border: 1.5px solid #e0e0e0;
        border-radius: 10px;
        /* No vertical padding: a fixed height centres the text on its own */
        padding: 0 38px 0 14px;
        font-size: 14px;
        color: #444;
        text-overflow: ellipsis;
        background-color: #f9f9f9;
        /* Inline SVG chevron - the old pseudo-element asked for a Font Awesome
           family this site does not ship, so it rendered a fallback glyph. */
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 8'%3E%3Cpath d='M1 1.5 6 6.5 11 1.5' fill='none' stroke='%23888' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        background-size: 12px 8px;
        cursor: pointer;
        outline: none;
        transition: border-color .2s, box-shadow .2s, background-color .2s;
    }
    /* custom.js runs $('select').niceSelect() site-wide. Nice Select swaps each
       <select> for a <div> and copies the original classes onto it, so the rules
       above style that div - and its own built-in arrow then stacks on top of
       our chevron. Hide theirs, and restore vertical centring (their base rule
       sets line-height:40px, which is short for our 48px field). */
    .search-bar .filter-select.nice-select { line-height: 45px; }
    .search-bar .filter-select.nice-select::after { display: none; }

    .search-bar .filter-select:hover {
        border-color: #cfd6de;
        background-color: #fff;
    }
    .search-bar .filter-select:focus {
        border-color: #C85A2A;
        background-color: #fff;
        box-shadow: 0 0 0 3px rgba(200,90,42,.12);
    }
    .search-bar .search-btn {
        background: #0D1F35;
        color: #fff;
        border: none;
        border-radius: 10px;
        height: 48px;
        padding: 0 28px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background .2s;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .search-bar .search-btn:hover { background: #C85A2A; }
    @media (max-width: 575px) {
        .search-bar { padding: 16px; gap: 10px; }
        .search-bar .filter-group { flex: 1 1 100%; }
        .search-bar .search-btn { width: 100%; }
    }

    /* ── Quick Renting Form ── */
    .quick-renting-section {
        background: #f8f9fa;
        padding: 80px 0 60px;
    }
    .quick-renting-form {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,.08);
        padding: 3rem;
        max-width: 800px;
        margin: 0 auto;
    }
    .car-banner {
        position: relative;
        width: 100%;
        height: 220px;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 1.5rem;
        background: #0D1F35 center / cover no-repeat;
    }
    .car-banner::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(13,31,53,0) 40%, rgba(13,31,53,.65) 100%);
    }
    .car-banner-caption {
        position: absolute;
        left: 20px;
        bottom: 16px;
        z-index: 2;
        color: #fff;
    }
    .car-banner-caption .name { font-size: 18px; font-weight: 700; line-height: 1.2; font-family: 'Playfair Display', serif; }
    .car-banner-caption .meta { font-size: 13px; opacity: .9; margin-top: 4px; }
    .car-banner-fallback {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,.6);
        font-size: 48px;
    }

    .form-title-wrap { text-align: center; margin-bottom: 2rem; }
    .form-title-bar { display: inline-block; width: 60px; height: 3px; background: var(--orange); border-radius: 3px; margin-bottom: 14px; }
    .form-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
        color: var(--navy);
        font-family: 'Playfair Display', serif;
    }
    .form-price-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #FFF0E8;
        color: var(--orange);
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        margin-top: 10px;
    }
    .quick-renting-form .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .quick-renting-form .form-group {
        display: flex;
        flex-direction: column;
    }
    .quick-renting-form .form-group label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: var(--navy);
        font-size: 14px;
    }
    .quick-renting-form .form-group input,
    .quick-renting-form .form-group select,
    .quick-renting-form .form-group textarea {
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s;
        font-family: 'Poppins', sans-serif !important;
        background: #fff;
        color: #333;
    }
    .quick-renting-form .form-group input[readonly] {
        background: #f7f7f7;
        color: #555;
        cursor: not-allowed;
    }
    .quick-renting-form .form-group input:focus,
    .quick-renting-form .form-group select:focus,
    .quick-renting-form .form-group textarea:focus {
        outline: none;
        border-color: var(--orange);
    }
    .quick-renting-form .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }

    /* date-time triple input */
    .datetime-row { display: grid; grid-template-columns: 1fr 70px 70px; gap: 8px; }
    .datetime-row input,
    .datetime-row select { padding: 0.75rem 0.5rem; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; background: #fff; }
    .datetime-row select { cursor: pointer; }

    .drive-info {
        font-size: 12px;
        color: #888;
        margin-top: 4px;
    }

    .submit-request-btn {
        background: var(--orange);
        color: #fff;
        border: none;
        padding: 14px 36px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin: 0 auto;
    }
    .submit-request-btn:hover { background: #a84520; }
    .submit-row { text-align: center; margin-top: 1.5rem; }
    .form-note {
        text-align: center;
        color: #666;
        font-size: 0.9rem;
        margin-top: 1rem;
    }

    .alert-stack { max-width: 800px; margin: 0 auto 1rem; }

    @media (max-width: 768px) {
        .quick-renting-form { padding: 2rem; margin: 1rem; }
        .quick-renting-form .form-row { grid-template-columns: 1fr; }
        .form-title { font-size: 1.5rem; }
        .datetime-row { grid-template-columns: 1fr 1fr 70px; }
    }
</style>
@endsection

@section('content')

    @include('partials.hero-breadcrumbs', ['breadcrumbs' => [['label' => 'Home', 'url' => url('/')], ['label' => 'Cars', 'url' => url('/cars')]]])

        <div class="search-bar-wrap">
            <form action="{{ url('/car/find') }}" method="GET" id="filterForm">
                <div class="search-bar">
                    <div class="filter-group">
                        <select id="brand_select" name="vehicle_brand" class="filter-select">
                            <option value="">Vehicle Brand</option>
                            @foreach (($brands ?? []) as $brand)
                                <option value="{{ $brand->name }}"
                                    @if(($vehicle->brand->name ?? null) == $brand->name) selected @endif>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <select id="model_select" name="vehicle_model" class="filter-select">
                            <option value="">Vehicle Model</option>
                            @if($vehicle->model->name ?? null)
                                <option value="{{ $vehicle->model->name }}" selected>{{ $vehicle->model->name }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="filter-group">
                        <select name="price" class="filter-select">
                            <option value="">Price</option>
                            <option value="low">Low to High</option>
                            <option value="high">High to Low</option>
                        </select>
                    </div>
                    <button type="submit" class="search-btn" id="sbmt_btn">
                        <span id="sbmt_btn_loading" class="fas fa-spinner fa-spin" style="display:none;"></span>
                        <i class="fas fa-search"></i>
                        <span id="sbmt_btn_text">Search</span>
                    </button>
                </div>
            </form>
        </div>

    {{-- Quick Renting Form --}}
    <section class="quick-renting-section">
        <div class="container">

            {{-- Errors / flash --}}
            @if ($errors && $errors->any())
                <div class="alert-stack">
                    <div class="alert alert-danger">
                        <ul style="margin:0; padding-left:18px;">
                            @foreach ($errors->all() as $error)
                                <li>{!! $error !!}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <div class="alert-stack">@include('flash::message')</div>

            <div class="quick-renting-form">
                @php
                    $images = is_array($vehicle->images) ? $vehicle->images : (is_string($vehicle->images) ? json_decode($vehicle->images, true) : []);
                    $carImage = (!empty($images) && count($images) > 0) ? $images[0] : null;
                @endphp
                <div class="car-banner" @if($carImage) style="background-image: url('{{ htmlspecialchars($carImage, ENT_QUOTES, 'UTF-8') }}');background-size:cover;background-position:center;" @endif>
                    @if(!$carImage)
                        <div class="car-banner-fallback"><i class="fas fa-car"></i></div>
                    @endif
                    <div class="car-banner-caption">
                        <div class="name">{{ trim(($vehicle->brand->name ?? '') . ' ' . ($vehicle->model->name ?? '')) }}</div>
                        <div class="meta">
                            {{ $vehicle->production_year ?? '' }}
                            @if($vehicle->transmission->name ?? null) · {{ $vehicle->transmission->name }} @endif
                            @if($vehicle->fuelType->name ?? null) · {{ $vehicle->fuelType->name }} @endif
                            @if($vehicle->seats ?? null) · {{ $vehicle->seats }} seats @endif
                        </div>
                    </div>
                </div>

                <div class="form-title-wrap">
                    <span class="form-title-bar"></span>
                    <h2 class="form-title">Quick Renting</h2>
                    <div class="form-price-tag">
                        <i class="fas fa-tag"></i>
                        @if($vehicle->price)
                            $ {{ number_format($vehicle->price) }} / day
                        @else
                            Contact us for pricing
                        @endif
                    </div>
                </div>

                {!! Form::open(['route' => ['car.book', $vehicle->id], 'id' => 'quickRentingForm']) !!}
                    <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

                    <div class="form-row">
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" id="full_name" name="name"
                                   value="{{ old('name', $name ?? (auth()->user()->name ?? '')) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email"
                                   value="{{ old('email', $email ?? (auth()->user()->email ?? '')) }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone_number">Phone number</label>
                            <input type="tel" id="phone_number" name="phone_number" maxlength="13"
                                   value="{{ old('phone_number', $phone_number ?? (auth()->user()->phone_number ?? '')) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="booking_type">Drive Type</label>
                            <select id="booking_type" name="booking_type" required>
                                <option value="1" {{ old('booking_type', $booking_type ?? '1') == '1' ? 'selected' : '' }}>Self Drive</option>
                                <option value="2" {{ old('booking_type', $booking_type ?? '1') == '2' ? 'selected' : '' }}>With a driver</option>
                            </select>
                            <span class="drive-info" id="drive-info-self">Self drive starting from 3 days</span>
                            <span class="drive-info" id="drive-info-driver" style="display:none;">Fuel exclusive</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="service">Service</label>
                            <input type="text" id="service" name="service" value="Car Rental" readonly>
                        </div>
                        <div class="form-group">
                            <label for="car_type">Car Type</label>
                            <input type="text" id="car_type" name="car_type"
                                   value="{{ trim(($vehicle->brand->name ?? '') . ' ' . ($vehicle->model->name ?? '') . ' ' . ($vehicle->production_year ?? '')) }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Pick-up Date &amp; Time</label>
                            <div class="datetime-row">
                                <input type="date" id="pickup_date" name="pickup_date"
                                       value="{{ old('pickup_date') }}" required>
                                <input type="text" id="pickup_time" name="pickup_time"
                                       value="{{ old('pickup_time', '00:00') }}" placeholder="00:00"
                                       pattern="^([01]?[0-9]):([0-5][0-9])$" required>
                                <select id="pickup_meridiem" name="pickup_meridiem">
                                    <option value="AM" {{ old('pickup_meridiem','AM') == 'AM' ? 'selected' : '' }}>AM</option>
                                    <option value="PM" {{ old('pickup_meridiem') == 'PM' ? 'selected' : '' }}>PM</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Return Date &amp; Time</label>
                            <div class="datetime-row">
                                <input type="date" id="return_date" name="return_date"
                                       value="{{ old('return_date') }}" required>
                                <input type="text" id="return_time" name="return_time"
                                       value="{{ old('return_time', '00:00') }}" placeholder="00:00"
                                       pattern="^([01]?[0-9]):([0-5][0-9])$" required>
                                <select id="return_meridiem" name="return_meridiem">
                                    <option value="AM" {{ old('return_meridiem','AM') == 'AM' ? 'selected' : '' }}>AM</option>
                                    <option value="PM" {{ old('return_meridiem') == 'PM' ? 'selected' : '' }}>PM</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row" id="destination_row" style="display:none;">
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label for="destination">Destination</label>
                            <input type="text" id="destination" name="destination"
                                   value="{{ old('destination') }}" maxlength="255"
                                   placeholder="Where would you like to go?">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label for="special_requests">Special Requests</label>
                            <textarea id="special_requests" name="message" rows="3"
                                      placeholder="Any special requirements...">{{ old('message') }}</textarea>
                        </div>
                    </div>

                    <div class="submit-row">
                        <button type="submit" class="submit-request-btn">
                            <i class="fas fa-paper-plane"></i>
                            Submit Request
                        </button>
                    </div>

                    <p class="form-note">Our team will contact you shortly to confirm your booking.</p>
                {!! Form::close() !!}
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {

        // ── Brand → Models AJAX (mirrors car list page) ──
        function getModels() {
            var brand = $('#brand_select').val();
            $('#sbmt_btn_loading').show();
            $('#sbmt_btn_text').hide();
            $('#sbmt_btn').attr('disabled', true);
            $('#model_select').attr('disabled', true);

            $.ajax({
                url: `{{ route('brand.models', ':brand_id') }}`.replace(':brand_id', brand),
                data: { _token: "{{ csrf_token() }}" },
                type: 'POST',
                success: function (data) {
                    data = $.map(data, function (value, index) { return { id: index, name: value }; });
                    var currentModel = "{{ $vehicle->model->name ?? '' }}";
                    $('#model_select option:not(:first)').remove();
                    data.forEach(function (value) {
                        var isSelected = currentModel == value.name;
                        $('#model_select').append($('<option>', { value: value.name, text: value.name, selected: isSelected }));
                    });
                    $('#sbmt_btn_loading').hide();
                    $('#sbmt_btn_text').show();
                    $('#sbmt_btn').attr('disabled', false);
                    $('#model_select').attr('disabled', false);
                },
                error: function () {
                    $('#sbmt_btn_loading').hide();
                    $('#sbmt_btn_text').show();
                    $('#sbmt_btn').attr('disabled', false);
                    $('#model_select').attr('disabled', false);
                }
            });
        }

        getModels();
        $('#brand_select').on('change', getModels);

        // ── Drive type toggle ──
        function applyDriveType() {
            var v = $('#booking_type').val();
            if (v == '2') {
                $('#destination_row').show();
                $('#drive-info-self').hide();
                $('#drive-info-driver').show();
            } else {
                $('#destination_row').hide();
                $('#drive-info-self').show();
                $('#drive-info-driver').hide();
            }
        }
        applyDriveType();
        $('#booking_type').on('change', applyDriveType);

        // ── Date constraints ──
        var todayStr = new Date().toISOString().slice(0, 10);
        $('#pickup_date').attr('min', todayStr);
        $('#return_date').attr('min', todayStr);

        $('#pickup_date').on('change', function () {
            var pickup = $(this).val();
            $('#return_date').attr('min', pickup);
            if ($('#return_date').val() && $('#return_date').val() < pickup) {
                $('#return_date').val('');
            }
        });

        // ── Submit guard ──
        $('#quickRentingForm').on('submit', function (e) {
            var btn = $(this).find('.submit-request-btn');
            btn.html('<i class="fas fa-spinner fa-spin"></i> Submitting...').prop('disabled', true);
        });
    });
</script>
@endsection

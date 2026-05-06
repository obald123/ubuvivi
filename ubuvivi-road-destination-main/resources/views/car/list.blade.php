@extends('layouts.guest')

@section('title')
    Car Rentals in Kigali, Rwanda - UBUVIVI
@endsection

@section('meta')
    <meta name="description"
        content="Car Rentals in Kigali, Rwanda - UBUVIVI We offer the best Car hire Rwanda, 4X4 rent a car Rwanda, and self drive Rwanda services">
    <meta name="keywords" content="ubuvivi, Rwanda Cars for Rental, Car Rentals in Kigali, Kigali Car Rentals">
@endsection

@section('body-class', 'hero-page')

@section('css')
<style>
    /* ── Hero ── */
    .cars-hero {
        position: relative;
        height: 80vh;
        min-height: 500px;
        background: url('{{ asset("assets/images/backgrounds/bg_8.jpg") }}') center center / cover no-repeat;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .cars-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,.55);
    }
    .cars-hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
        padding-bottom: 80px;
    }
    .cars-hero-content h1 {
        font-size: clamp(36px, 6vw, 64px);
        font-weight: 800;
        margin-bottom: 0;
        text-shadow: 0 2px 16px rgba(0,0,0,.4);
    }

    /* ── Search bar ── */
    .search-bar-wrap {
        position: absolute;
        bottom: -36px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        width: 90%;
        max-width: 860px;
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
        flex: 1;
        min-width: 160px;
        position: relative;
    }
    .search-bar .filter-select {
        width: 100%;
        appearance: none;
        -webkit-appearance: none;
        border: 1.5px solid #e0e0e0;
        border-radius: 10px;
        padding: 12px 36px 12px 14px;
        font-size: 14px;
        color: #444;
        background: #f9f9f9;
        cursor: pointer;
        outline: none;
        transition: border-color .2s;
    }
    .search-bar .filter-select:focus { border-color: #C85A2A; }
    .search-bar .filter-group::after {
        content: '\f107';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        pointer-events: none;
        font-size: 13px;
    }
    .search-bar .search-btn {
        background: #0D1F35;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 12px 28px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background .2s;
        white-space: nowrap;
    }
    .search-bar .search-btn:hover { background: #C85A2A; }

    /* ── Cars Grid ── */
    .cars-grid-section {
        background: #f7f7f7;
        padding: 100px 0 80px;
    }
    .car-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 16px rgba(0,0,0,.07);
        overflow: hidden;
        transition: transform .25s, box-shadow .25s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .car-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 36px rgba(0,0,0,.13);
    }
    .car-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 18px 8px;
    }
    .car-card-name {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
        line-height: 1.3;
    }
    .car-year-badge {
        border: 2px dashed #bbb;
        border-radius: 50px;
        padding: 4px 14px;
        font-size: 13px;
        font-weight: 600;
        color: #555;
        white-space: nowrap;
    }
    .car-card-img-wrap {
        padding: 10px 24px 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 160px;
    }
    .car-card-img-wrap img {
        max-height: 150px;
        max-width: 100%;
        object-fit: contain;
        display: block;
    }
    .car-card-img-wrap .img-bg {
        width: 100%;
        height: 160px;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }
    .car-card-specs {
        display: flex;
        justify-content: center;
        gap: 40px;
        padding: 12px 18px;
        border-top: 1px solid #f0f0f0;
        border-bottom: 1px solid #f0f0f0;
    }
    .spec-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
    }
    .spec-item .spec-icon {
        font-size: 26px;
        color: #1a1a1a;
        line-height: 1;
    }
    .spec-item .spec-label {
        font-size: 12px;
        color: #555;
        font-weight: 500;
    }
    .car-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 18px;
        margin-top: auto;
    }
    .car-price {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
    }
    .car-price span { font-size: 13px; color: #888; font-weight: 400; }
    .rent-car-btn {
        background: #C85A2A;
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 10px 22px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: background .2s;
        display: inline-block;
    }
    .rent-car-btn:hover { background: #a84520; color: #fff; text-decoration: none; }
    .no-cars {
        text-align: center;
        padding: 80px 0;
        color: #888;
        font-size: 18px;
    }

    /* ── Quick Renting Form ── */
    .quick-renting-section {
        background: #f8f9fa;
        padding: 60px 0;
    }
    .quick-renting-form {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        padding: 3rem;
        max-width: 800px;
        margin: 0 auto;
    }
    .form-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 2rem;
        color: var(--navy);
        font-family: 'Playfair Display', serif;
        text-align: center;
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
    }
    .quick-renting-form .form-group input,
    .quick-renting-form .form-group textarea {
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s;
        font-family: 'Poppins', sans-serif;
    }
    .quick-renting-form .form-group input:focus,
    .quick-renting-form .form-group textarea:focus {
        outline: none;
        border-color: var(--orange);
    }
    .quick-renting-form .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }
    .submit-request-btn {
        background: var(--orange);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.3s;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    .submit-request-btn:hover {
        background: #a84520;
    }
    .form-note {
        text-align: center;
        color: #666;
        font-size: 0.9rem;
        margin-top: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    .form-note i {
        color: var(--orange);
    }

    @media (max-width: 768px) {
        .quick-renting-form {
            padding: 2rem;
            margin: 1rem;
        }
        .quick-renting-form .form-row {
            grid-template-columns: 1fr;
        }
        .form-title {
            font-size: 1.5rem;
        }
    }
</style>
@endsection

@section('content')

    {{-- ── Hero ── --}}
    <section class="cars-hero">
        <div class="cars-hero-content">
            <h1>Find Your Perfect Car</h1>
        </div>

        {{-- Search bar --}}
        <div class="search-bar-wrap">
            <form action="/cars" method="GET">
                <div class="search-bar">
                    <div class="filter-group">
                        <select id="brand_select" name="vehicle_brand" class="filter-select">
                            <option value="">Vehicle Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->name }}"
                                    @if(request('vehicle_brand') == $brand->name) selected @endif>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <select id="model_select" name="vehicle_model" class="filter-select">
                            <option value="">Vehicle Model</option>
                            @if(request('vehicle_model'))
                                <option value="{{ request('vehicle_model') }}" selected>{{ request('vehicle_model') }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="filter-group">
                        <select name="price" class="filter-select">
                            <option value="">Price</option>
                            <option value="low" @if(request('price')=='low') selected @endif>Low to High</option>
                            <option value="high" @if(request('price')=='high') selected @endif>High to Low</option>
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
    </section>

    {{-- ── Cars Grid ── --}}
    <section class="cars-grid-section">
        <div class="container">
            @if ($vehicles->count())
                <div class="row">
                    @foreach ($vehicles as $vehicle)
                        <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                            <div class="car-card w-100">
                                {{-- Header: name + year --}}
                                <div class="car-card-header">
                                    <h3 class="car-card-name">
                                        {{ $vehicle->brand->name ?? '' }} {{ $vehicle->model->name ?? '' }}
                                    </h3>
                                    @if($vehicle->production_year)
                                        <span class="car-year-badge">{{ $vehicle->production_year }}</span>
                                    @endif
                                </div>

                                {{-- Car image --}}
                                <div class="car-card-img-wrap">
                                    @if($vehicle->images && count($vehicle->images))
                                        <div class="img-bg" style="background-image: url('{{ $vehicle->images[0] }}')"></div>
                                    @else
                                        <img src="{{ asset('assets/images/vehicles/not_found.png') }}" alt="{{ $vehicle->brand->name ?? '' }} {{ $vehicle->model->name ?? '' }}">
                                    @endif
                                </div>

                                {{-- Description --}}
                                @if($vehicle->description)
                                    <div style="padding: 0 18px 12px;">
                                        <p style="font-size: 14px; color: #666; line-height: 1.5; margin: 0;">
                                            {{ Str::limit($vehicle->description, 150) }}
                                        </p>
                                    </div>
                                @endif

                                {{-- Specs --}}
                                <div class="car-card-specs">
                                    <div class="spec-item">
                                        @if(strtolower($vehicle->transmission->name ?? '') == 'automatic')
                                            <span class="spec-icon">&#x2684;</span>
                                        @else
                                            <span class="spec-icon" style="font-size:22px;">
                                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="7" cy="7" r="3" fill="#1a1a1a"/><circle cx="14" cy="7" r="3" fill="#1a1a1a"/>
                                                    <circle cx="21" cy="7" r="3" fill="#1a1a1a"/><circle cx="7" cy="21" r="3" fill="#1a1a1a"/>
                                                    <circle cx="14" cy="21" r="3" fill="#1a1a1a"/><circle cx="21" cy="21" r="3" fill="#1a1a1a"/>
                                                    <line x1="14" y1="10" x2="14" y2="18" stroke="#1a1a1a" stroke-width="2"/>
                                                </svg>
                                            </span>
                                        @endif
                                        <span class="spec-label">{{ $vehicle->transmission->name ?? 'N/A' }}</span>
                                    </div>
                                    <div class="spec-item">
                                        <span class="spec-icon"><i class="fas fa-gas-pump" style="font-size:22px;"></i></span>
                                        <span class="spec-label">{{ $vehicle->fuelType->name ?? 'N/A' }}</span>
                                    </div>
                                </div>

                                {{-- Footer: price + CTA --}}
                                <div class="car-card-footer">
                                    <div class="car-price">
                                        $ {{ number_format($vehicle->price ?? 0) }}
                                        <span>/ day</span>
                                    </div>
                                    <a href="{{ route('car.booking', $vehicle->id) }}" class="rent-car-btn">
                                        Rent Car
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-cars">
                    <i class="fas fa-car" style="font-size:40px; color:#C85A2A; display:block; margin-bottom:16px;"></i>
                    No vehicles available at the moment.
                </div>
            @endif
        </div>
    </section>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        getModels();
        $('#brand_select').on('change', getModels);

        function getModels() {
            var brand = $('#brand_select').val();
            $('#sbmt_btn_loading').show();
            $('#sbmt_btn_text').hide();
            $('#sbmt_btn').attr('disabled', true);
            $('#model_select').attr('disabled', true);

            $.ajax({
                url: `{{ route('brand.models', ':brand_id') }}`.replace(':brand_id', brand),
                data: { _token: "{{ csrf_token() }}" },
                type: "POST",
                success: function (data) {
                    data = $.map(data, function (value, index) { return { id: index, name: value }; });
                    $('#model_select option:not(:first)').remove();
                    data.forEach(function (value) {
                        var isSelected = "{{ request('vehicle_model') }}" == value.name;
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

    });
</script>
@endsection

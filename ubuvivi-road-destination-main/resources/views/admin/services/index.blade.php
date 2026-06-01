@extends('layouts.app')

@section('title')
    Services
@endsection

@section('css')
<style>
    .services-page {
        display: flex;
        flex-direction: column;
        gap: 22px;
        width: 100%;
        --admin-search-width: 392px;
    }

    .adm-topbar { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:14px; }
    .adm-topbar h1 { font-size:28px; font-weight:800; color:#1a1a2e; margin:0; }
    .adm-topbar-right { display:flex; align-items:center; gap:12px; flex-wrap:wrap; justify-content:flex-end; }
    .adm-search { display:flex; align-items:center; gap:10px; background:#fff; border:1px solid #e8e8e8; border-radius:10px; padding:9px 16px; width:260px; }
    .adm-search i { color:#bbb; font-size:14px; }
    .adm-search input { border:none; outline:none; background:transparent; font-size:14px; color:#333; width:100%; }
    .adm-search input::placeholder { color:#bbb; }
    .adm-bell { width:40px; height:40px; border-radius:50%; background:#fff; border:1px solid #e8e8e8; display:flex; align-items:center; justify-content:center; color:#666; cursor:pointer; position:relative; }
    .adm-bell-dot { position:absolute; top:9px; right:9px; width:8px; height:8px; border-radius:50%; background:#e74c3c; border:2px solid #fff; }
    .adm-avatar { width:40px; height:40px; border-radius:50%; background:#1a1a2e; color:#fff; display:flex; align-items:center; justify-content:center; font-size:15px; font-weight:700; cursor:pointer; }
    .adm-new-btn { background:#0D1F35; color:#fff; border:none; border-radius:10px; padding:10px 20px; font-size:14px; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:8px; white-space:nowrap; transition:background .2s; }
    .adm-new-btn:hover { background:#1e3a5f; }

    .svc-toolbar {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
    }

    .svc-tabbar {
        flex: 1 1 auto;
        min-width: 0;
        border-bottom: 1px solid #d7deea;
        overflow-x: auto;
        overflow-y: hidden;
    }

    .svc-tabs {
        display: inline-flex;
        align-items: center;
        gap: 18px;
        min-width: max-content;
    }

    .svc-tab {
        padding: 0 12px 11px;
        font-size: 14px;
        font-weight: 500;
        color: #4d5665;
        cursor: pointer;
        border: none;
        background: none;
        border-bottom: 3px solid transparent;
        transition: color .2s, border-color .2s;
        white-space: nowrap;
    }

    .svc-tab.active {
        color: #162736;
        border-bottom-color: #2f9ff0;
        font-weight: 600;
    }

    .svc-tab:hover:not(.active) {
        color: #162736;
    }

    /* Service grid */
    .svc-grid { display:grid; grid-template-columns:repeat(3, minmax(0, 1fr)); gap:18px; }
    @media(max-width:900px) { .svc-grid { grid-template-columns:repeat(2,1fr); } }
    @media(max-width:600px) { .svc-grid { grid-template-columns:1fr; } }

    .svc-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 12px 28px rgba(18, 44, 59, .05);
        border: 1px solid #e2e8f1;
    }

    .svc-card img {
        width: 100%;
        height: 112px;
        object-fit: cover;
        display: block;
    }

    .svc-card-body {
        padding: 12px 14px 14px;
    }

    .svc-card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 8px;
    }

    .svc-card-title {
        font-size: 15px;
        font-weight: 600;
        color: #182b39;
        line-height: 1.35;
    }

    .svc-card-price {
        font-size: 12px;
        font-weight: 600;
        color: #0f74ba;
        white-space: nowrap;
    }

    .svc-card-desc {
        font-size: 12.5px;
        color: #4d5665;
        line-height: 1.45;
        margin-bottom: 16px;
        min-height: 54px;
    }

    .svc-card-actions {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .btn-edit-svc,
    .btn-del-svc {
        height: 36px;
        border-radius: 8px;
        padding: 0 14px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s, color .2s, border-color .2s;
    }

    .btn-edit-svc {
        background: #0f5f86;
        color: #fff;
        border: 1px solid #0f5f86;
    }

    .btn-edit-svc:hover {
        background: #0c4d6d;
        border-color: #0c4d6d;
    }

    .btn-del-svc {
        background: #fff;
        color: #0f5f86;
        border: 1px solid #0f5f86;
    }

    .btn-del-svc:hover {
        background: #0f5f86;
        color: #fff;
    }

    .no-services { text-align:center; padding:48px 20px; color:#bbb; }
    .no-services i { font-size:32px; display:block; margin-bottom:12px; }

    /* Car Rental Card */
    .car-svc-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e2e8f1;
        box-shadow: 0 12px 28px rgba(18,44,59,.05);
        padding: 16px 18px 18px;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .car-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .car-card-name {
        font-size: 17px;
        font-weight: 700;
        color: #182b39;
        line-height: 1.2;
    }

    .car-card-year {
        font-size: 13px;
        font-weight: 700;
        color: #182b39;
        border: 2px dashed #a0aab5;
        border-radius: 999px;
        padding: 3px 12px;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .car-card-img-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 120px;
    }

    .car-card-img-wrap img {
        max-width: 100%;
        max-height: 120px;
        object-fit: contain;
    }

    .car-card-specs {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 36px;
    }

    .car-spec {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
        color: #374151;
    }

    .car-spec i {
        font-size: 22px;
        color: #374151;
    }

    .car-spec span {
        font-size: 13px;
        font-weight: 500;
    }

    .car-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 2px;
    }

    .car-card-price {
        font-size: 18px;
        font-weight: 700;
        color: #182b39;
    }

    .car-card-actions {
        display: flex;
        gap: 8px;
    }

    .btn-car-edit {
        background: #e8670a;
        color: #fff;
        border: 1px solid #e8670a;
        border-radius: 8px;
        height: 34px;
        padding: 0 16px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s;
    }

    .btn-car-edit:hover {
        background: #c9560a;
        border-color: #c9560a;
    }

    .btn-car-delete {
        background: #fff;
        color: #e8670a;
        border: 1px solid #e8670a;
        border-radius: 8px;
        height: 34px;
        padding: 0 16px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s;
    }

    .btn-car-delete:hover {
        background: #e8670a;
        color: #fff;
    }

    /* Tab content visibility */
    .tab-pane { display:none; }
    .tab-pane.active { display:block; }

    /* ── Modal ── */
    .adm-modal-overlay { position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,.45); display:flex; align-items:center; justify-content:center; z-index:2000; padding:16px; }
    .adm-modal { background:#fff; border-radius:16px; padding:28px 32px; max-width:780px; width:100%; max-height:92vh; overflow-y:auto; }
    .adm-modal-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:22px; }
    .adm-modal-head h3 { font-size:19px; font-weight:700; color:#1a1a2e; margin:0; }
    .adm-modal-close { background:none; border:none; font-size:22px; cursor:pointer; color:#aaa; line-height:1; }
    .adm-modal-close:hover { color:#333; }

    /* Form grid rows */
    .adm-form-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px; }
    .adm-form-row.single { grid-template-columns:1fr; }
    .adm-form-group { margin-bottom:0; }
    .adm-form-group label { display:block; font-size:13px; font-weight:500; color:#444; margin-bottom:6px; }
    .adm-form-group input,
    .adm-form-group textarea,
    .adm-form-group select { width:100%; padding:10px 14px; border:1.5px solid #e0e0e0; border-radius:8px; font-size:14px; outline:none; font-family:inherit; resize:vertical; color:#1a1a2e; background:#fff; }
    .adm-form-group input:focus,
    .adm-form-group textarea:focus,
    .adm-form-group select:focus { border-color:#0D1F35; }

    /* Highlights */
    .highlights-box { border:1.5px solid #e8e8e8; border-radius:10px; padding:14px 16px; margin-bottom:16px; }
    .highlight-row { display:grid; grid-template-columns:1fr 2fr auto auto; gap:10px; align-items:center; margin-bottom:10px; }
    .highlight-row:last-of-type { margin-bottom:0; }
    .highlight-row input { padding:9px 12px; border:1.5px solid #e0e0e0; border-radius:8px; font-size:13px; outline:none; font-family:inherit; width:100%; }
    .highlight-row input:focus { border-color:#0D1F35; }
    .btn-add-img { background:#f5f5f5; border:1.5px solid #e0e0e0; border-radius:8px; padding:8px 14px; font-size:13px; cursor:pointer; white-space:nowrap; color:#444; display:flex; align-items:center; gap:6px; }
    .btn-add-img:hover { background:#ebebeb; }
    .btn-del-row { background:none; border:none; cursor:pointer; color:#bbb; font-size:18px; padding:4px; }
    .btn-del-row:hover { color:#e74c3c; }
    .add-highlight-btn { display:inline-flex; align-items:center; gap:8px; background:none; border:none; color:#555; font-size:14px; font-weight:500; cursor:pointer; padding:6px 0; }
    .add-highlight-btn:hover { color:#0D1F35; }
    .highlight-thumb { width:52px; height:52px; border-radius:6px; object-fit:cover; display:block; }
    .highlight-img-wrap { position:relative; display:inline-flex; }
    .highlight-img-remove { position:absolute; top:-6px; right:-6px; width:18px; height:18px; border-radius:50%; background:#e74c3c; color:#fff; border:none; cursor:pointer; font-size:11px; display:flex; align-items:center; justify-content:center; }

    /* Image upload area */
    .img-upload-area { border:1.5px solid #e8e8e8; border-radius:10px; padding:14px; display:flex; flex-wrap:wrap; gap:12px; align-items:center; min-height:80px; margin-bottom:16px; }
    .img-slot { width:90px; height:80px; border:2px dashed #d0d0d0; border-radius:8px; display:flex; align-items:center; justify-content:center; cursor:pointer; color:#bbb; font-size:22px; transition:border-color .2s; flex-shrink:0; }
    .img-slot:hover { border-color:#0D1F35; color:#0D1F35; }
    .img-preview-wrap { position:relative; }
    .img-preview { width:90px; height:80px; object-fit:cover; border-radius:8px; display:block; }
    .img-preview-remove { position:absolute; top:-6px; right:-6px; width:20px; height:20px; border-radius:50%; background:#e74c3c; color:#fff; border:none; cursor:pointer; font-size:12px; display:flex; align-items:center; justify-content:center; }

    /* Price counter */
    .price-counter { display:inline-flex; align-items:center; gap:14px; font-size:14px; color:#444; margin-bottom:16px; }
    .price-counter-label { font-size:13px; font-weight:500; color:#444; }
    .btn-counter { width:28px; height:28px; border-radius:50%; border:1.5px solid #ccc; background:#fff; font-size:16px; cursor:pointer; display:flex; align-items:center; justify-content:center; color:#333; transition:border-color .2s; }
    .btn-counter:hover { border-color:#0D1F35; color:#0D1F35; }
    .price-val { font-size:15px; font-weight:700; color:#0D1F35; min-width:44px; text-align:center; }

    /* Available checkbox */
    .adm-check-row { display:flex; align-items:center; gap:8px; font-size:14px; color:#444; margin-bottom:16px; }
    .adm-check-row input[type=checkbox] { width:16px; height:16px; accent-color:#0D1F35; cursor:pointer; }

    /* Footer */
    .adm-modal-foot { display:flex; justify-content:flex-end; margin-top:8px; border-top:1px solid #f0f0f0; padding-top:18px; }
    .btn-save { background:#0D1F35; color:#fff; border:none; padding:11px 28px; border-radius:8px; font-size:14px; font-weight:600; cursor:pointer; }
    .btn-save:hover { background:#1e3a5f; }

    /* Section label inside modal */
    .adm-section-label { font-size:13px; font-weight:600; color:#1a1a2e; margin-bottom:10px; }

    @media(max-width:991px) {
        .svc-grid { grid-template-columns: repeat(2, 1fr); }
        .adm-modal { padding: 24px 22px 28px; }
    }
    @media(max-width:767px) {
        .svc-grid { grid-template-columns: 1fr; }
        .svc-toolbar { align-items: stretch; }
        .svc-tabbar { width: 100%; overflow-x: auto; }
        .adm-modal-overlay { padding: 0; align-items: flex-end; }
        .adm-modal { border-radius: 18px 18px 0 0; max-height: 92vh; width: 100%; max-width: 100%; padding: 22px 16px 28px; }
        .adm-modal-row { grid-template-columns: 1fr !important; }
        .adm-modal-foot { justify-content: stretch; }
        .adm-modal-foot .btn-save { width: 100%; text-align: center; }
    }
    @media(max-width:480px) {
        .svc-tabbar button { font-size: 12px; padding: 6px 12px; }
    }
</style>
@endsection

@section('content')
    <div class="services-page">
        @include('layouts.partials.admin_topbar', [
            'title' => 'Services',
            'searchInputId' => 'searchInput',
            'searchAriaLabel' => 'Search services',
        ])

        <div class="svc-toolbar">
            <div class="svc-tabbar">
                <div class="svc-tabs">
                    <button class="svc-tab active" data-pane="tours">Tours &amp; Travel</button>
                    <button class="svc-tab" data-pane="cars">Car Rental</button>
                </div>
            </div>
            <button class="admin-primary-btn" type="button" id="btnNewService">
                <i class="fas fa-plus"></i> New Service
            </button>
        </div>

        {{-- Tours & Travel --}}
        <div class="tab-pane active" id="pane-tours">
            @if($tours->count())
            <div class="svc-grid">
                @foreach($tours as $tour)
                @php
                    $tourImages = is_array($tour->images) ? $tour->images : (is_string($tour->images) ? json_decode($tour->images, true) : []);
                    $tourImg = (!empty($tourImages) && isset($tourImages[0])) ? $tourImages[0] : asset('assets/images/backgrounds/bg_11.jpg');
                @endphp
                <div class="svc-card">
                    <img src="{{ $tourImg }}" alt="{{ $tour->title }}" onerror="this.onerror=null;this.src='{{ asset('assets/images/backgrounds/bg_11.jpg') }}'">
                    <div class="svc-card-body">
                        <div class="svc-card-head">
                            <div class="svc-card-title">{{ $tour->title }}</div>
                            <div class="svc-card-price">{{ ($tour->price ?? 0) > 0 ? '$'.number_format($tour->price).' per person' : 'Price on request' }}</div>
                        </div>
                        <p class="svc-card-desc">{{ Str::limit($tour->description ?? 'Explore amazing destinations with our guided tours. Professional guides, comfortable transportation, and unforgettable experiences.', 150) }}</p>
                        <div class="svc-card-actions">
                            <button class="btn-edit-svc" data-type="tour" data-id="{{ $tour->id }}">Edit</button>
                            <button class="btn-del-svc"  data-type="tour" data-id="{{ $tour->id }}">Delete</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="no-services"><i class="fas fa-map-marked-alt"></i>No tours available.</div>
            @endif
        </div>

        {{-- Car Rental --}}
        <div class="tab-pane" id="pane-cars">
            @if($vehicles->count())
            <div class="svc-grid">
                @foreach($vehicles as $vehicle)
                @php
                    $vImages = is_array($vehicle->images) ? $vehicle->images : [];
                    $vImg = count($vImages) ? $vImages[0] : asset('assets/images/vehicles/not_found.png');
                @endphp
                <div class="car-svc-card">
                    <div class="car-card-header">
                        <span class="car-card-name">{{ $vehicle->brand->name ?? '' }} {{ $vehicle->model->name ?? '' }}</span>
                        <span class="car-card-year">{{ $vehicle->production_year ?? '' }}</span>
                    </div>
                    <div class="car-card-img-wrap">
                        <img src="{{ $vImg }}" alt="{{ $vehicle->brand->name ?? '' }} {{ $vehicle->model->name ?? '' }}" onerror="this.onerror=null;this.src='{{ asset('assets/images/vehicles/not_found.png') }}'">
                    </div>
                    <div class="car-card-specs">
                        <div class="car-spec">
                            <i class="fas fa-cog"></i>
                            <span>{{ $vehicle->transmission->name ?? 'Manual' }}</span>
                        </div>
                        <div class="car-spec">
                            <i class="fas fa-gas-pump"></i>
                            <span>{{ $vehicle->fuelType->name ?? 'Diesel' }}</span>
                        </div>
                    </div>
                    <div class="car-card-footer">
                        <span class="car-card-price">${{ number_format($vehicle->price ?? 0) }}</span>
                        <div class="car-card-actions">
                            <button class="btn-car-edit btn-edit-svc" data-type="car" data-id="{{ $vehicle->id }}">Edit</button>
                            <button class="btn-car-delete btn-del-svc" data-type="car" data-id="{{ $vehicle->id }}">Delete</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="no-services"><i class="fas fa-car"></i>No vehicles available.</div>
            @endif
        </div>

    </div>

    {{-- ══ TOUR MODAL ══ --}}
    <div class="adm-modal-overlay" id="tourModal" style="display:none;">
        <div class="adm-modal">
            <div class="adm-modal-head">
                <h3 id="tourModalTitle">Add Service</h3>
                <button class="adm-modal-close" onclick="closeModal('tourModal')">&times;</button>
            </div>
            <form id="tourForm" action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="tourMethod" value="POST">
                <input type="hidden" name="service_type" value="tour">
                <input type="hidden" name="existing_images" id="tourExistingImages" value="[]">
                <input type="hidden" name="existing_image_ids" id="tourExistingImageIds" value="[]">

                <div class="adm-form-row">
                    <div class="adm-form-group">
                        <label>Tour Title</label>
                        <input type="text" name="title" id="tourTitle" placeholder="" required>
                    </div>
                    <div class="adm-form-group">
                        <label>Days</label>
                        <input type="number" name="days" id="tourDays" min="1" value="1">
                    </div>
                </div>

                <div class="adm-form-row">
                    <div class="adm-form-group">
                        <label>Description</label>
                        <textarea name="description" id="tourDesc" rows="3"></textarea>
                    </div>
                    <div class="adm-form-group">
                        <label>Inclusions <span style="font-weight:400;color:#999">(comma separated)</span></label>
                        <textarea name="inclusions" id="tourInclusions" rows="3"></textarea>
                    </div>
                    <div class="adm-form-group">
                        <label>Exclusions <span style="font-weight:400;color:#999">(comma separated)</span></label>
                        <textarea name="exclusions" id="tourExclusions" rows="3"></textarea>
                    </div>
                </div>

                <div class="adm-section-label">Tour Highlights</div>
                <div class="highlights-box">
                    <div id="highlightsList"></div>
                    <button type="button" class="add-highlight-btn" id="btnAddHighlight">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Add Highlight
                    </button>
                </div>

                <div class="adm-section-label">Tour image</div>
                <div class="img-upload-area" id="tourImagesArea">
                    <label class="img-slot" id="tourImgSlot" title="Add image">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        <input type="file" name="tour_images[]" id="tourImageInput" accept="image/*" multiple style="display:none" onchange="handleTourImages(this)">
                    </label>
                </div>

                <div class="adm-form-group" style="margin-bottom:8px;">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                        <input type="checkbox" id="tourPriceOnRequest" onchange="toggleTourPrice(this)" style="width:16px;height:16px;accent-color:#0D1F35;">
                        Price on request (no fixed price)
                    </label>
                </div>
                <div class="price-counter" id="tourPriceRow">
                    <span class="price-counter-label">Price per Person (dollars):</span>
                    <button type="button" class="btn-counter" onclick="changePrice('tourPrice', -50)">&#8722;</button>
                    <span class="price-val" id="tourPriceDisplay">100</span>
                    <input type="hidden" name="price" id="tourPrice" value="100">
                    <button type="button" class="btn-counter" onclick="changePrice('tourPrice', 50)">&#43;</button>
                </div>

                <div class="adm-modal-foot">
                    <button type="submit" class="btn-save">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ══ CAR MODAL ══ --}}
    <div class="adm-modal-overlay" id="carModal" style="display:none;">
        <div class="adm-modal">
            <div class="adm-modal-head">
                <h3 id="carModalTitle">Add Service</h3>
                <button class="adm-modal-close" onclick="closeModal('carModal')">&times;</button>
            </div>
            <form id="carForm" action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="carMethod" value="POST">
                <input type="hidden" name="service_type" value="car">
                <input type="hidden" name="existing_images" id="carExistingImages" value="[]">
                <input type="hidden" name="existing_image_ids" id="carExistingImageIds" value="[]">

                <div class="adm-form-row">
                    <div class="adm-form-group">
                        <label>Car Name</label>
                        <input type="text" name="car_name" id="carName" placeholder="" required>
                    </div>
                    <div class="adm-form-group">
                        <label>Year</label>
                        <input type="number" name="year" id="carYear" min="2000" max="2030" value="{{ date('Y') }}">
                    </div>
                </div>

                <div class="adm-form-row">
                    <div class="adm-form-group">
                        <label>Vehicle Transmission</label>
                        <input type="text" name="transmission" id="carTransmission" placeholder="e.g. Manual">
                    </div>
                    <div class="adm-form-group">
                        <label>Vehicle Fuel Type</label>
                        <input type="text" name="fuel_type" id="carFuelType" placeholder="e.g. Diesel">
                    </div>
                </div>

                <div class="adm-section-label">Vehicle image</div>
                <div class="img-upload-area" id="carImagesArea">
                    <label class="img-slot" id="carImgSlot" title="Add image">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        <input type="file" name="vehicle_images[]" id="carImageInput" accept="image/*" multiple style="display:none" onchange="handleCarImages(this)">
                    </label>
                </div>

                <div class="price-counter">
                    <span class="price-counter-label">Price per Day (dollars):</span>
                    <button type="button" class="btn-counter" onclick="changePrice('carPrice', -10)">&#8722;</button>
                    <span class="price-val" id="carPriceDisplay">100</span>
                    <input type="hidden" name="price" id="carPrice" value="100">
                    <button type="button" class="btn-counter" onclick="changePrice('carPrice', 10)">&#43;</button>
                </div>

                <div class="adm-check-row">
                    <input type="checkbox" name="available" id="carAvailable">
                    <label for="carAvailable">Available</label>
                </div>

                <div class="adm-modal-foot">
                    <button type="submit" class="btn-save">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script>
var activeTab = 'tours';
var highlightIndex = 0;

document.addEventListener('DOMContentLoaded', function () {

    // ── Tabs ──
    document.querySelectorAll('.svc-tab').forEach(function (tab) {
        tab.addEventListener('click', function () {
            document.querySelectorAll('.svc-tab').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
            document.getElementById('pane-' + tab.dataset.pane).classList.add('active');
            activeTab = tab.dataset.pane;
        });
    });

    // ── Search ──
    var si = document.getElementById('searchInput');
    if (si) si.addEventListener('input', function () {
        var val = si.value.toLowerCase();
        document.querySelectorAll('.svc-card, .car-svc-card').forEach(function (card) {
            card.style.display = card.textContent.toLowerCase().includes(val) ? '' : 'none';
        });
    });

    // ── New Service button — open the right modal based on active tab ──
    document.getElementById('btnNewService').addEventListener('click', function () {
        if (activeTab === 'cars') {
            openCarModal();
        } else {
            openTourModal();
        }
    });

    // ── Edit buttons ──
    document.querySelectorAll('.btn-edit-svc').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var type = this.dataset.type;
            var id   = this.dataset.id;
            fetch('/services/' + type + '/' + id + '/data')
                .then(r => r.json())
                .then(data => {
                    if (type === 'tour') loadTourModal(data);
                    else if (type === 'car') loadCarModal(data);
                });
        });
    });

    // ── Delete buttons ──
    document.querySelectorAll('.btn-del-svc').forEach(function (btn) {
        btn.addEventListener('click', function () {
            if (!confirm('Delete this service?')) return;
            var id   = this.dataset.id;
            var type = this.dataset.type;
            var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '/services/' + id;
            [['_token', csrf], ['_method', 'DELETE'], ['service_type', type]].forEach(function (p) {
                var inp = document.createElement('input');
                inp.type = 'hidden'; inp.name = p[0]; inp.value = p[1];
                form.appendChild(inp);
            });
            document.body.appendChild(form);
            form.submit();
        });
    });

    // ── Add Highlight ──
    document.getElementById('btnAddHighlight').addEventListener('click', function () {
        addHighlightRow();
    });
});

// ── Price counter ──
function toggleTourPrice(checkbox) {
    var row = document.getElementById('tourPriceRow');
    row.style.display = checkbox.checked ? 'none' : '';
    if (checkbox.checked) {
        document.getElementById('tourPrice').value = 0;
        document.getElementById('tourPriceDisplay').textContent = 0;
    }
}

function changePrice(inputId, delta) {
    var inp = document.getElementById(inputId);
    var val = Math.max(0, (parseInt(inp.value) || 0) + delta);
    inp.value = val;
    document.getElementById(inputId + 'Display').textContent = val;
}

function setPrice(inputId, val) {
    val = parseInt(val) || 0;
    document.getElementById(inputId).value = val;
    document.getElementById(inputId + 'Display').textContent = val;
}

// ── Close modal ──
function closeModal(id) {
    document.getElementById(id).style.display = 'none';
}

// ── Tour modal (add) ──
function openTourModal() {
    document.getElementById('tourModalTitle').textContent = 'Add Service';
    document.getElementById('tourForm').action = '{{ route("services.store") }}';
    document.getElementById('tourMethod').value = 'POST';
    document.getElementById('tourTitle').value = '';
    document.getElementById('tourDays').value = 1;
    document.getElementById('tourDesc').value = '';
    document.getElementById('tourInclusions').value = '';
    document.getElementById('tourExclusions').value = '';
    document.getElementById('tourPriceOnRequest').checked = false;
    document.getElementById('tourPriceRow').style.display = '';
    document.getElementById('highlightsList').innerHTML = '';
    document.getElementById('tourExistingImages').value = '[]';
    document.getElementById('tourExistingImageIds').value = '[]';
    clearImgArea('tourImagesArea', 'tourImgSlot');
    setPrice('tourPrice', 100);
    highlightIndex = 0;
    addHighlightRow();
    document.getElementById('tourModal').style.display = 'flex';
}

// ── Tour modal (edit) ──
function loadTourModal(data) {
    document.getElementById('tourModalTitle').textContent = 'Edit Service';
    document.getElementById('tourForm').action = '/services/' + data.id;
    document.getElementById('tourMethod').value = 'PUT';
    document.getElementById('tourTitle').value = data.title || '';
    document.getElementById('tourDays').value = data.days || 1;
    document.getElementById('tourDesc').value = data.description || '';
    document.getElementById('tourInclusions').value = data.inclusions || '';
    document.getElementById('tourExclusions').value = data.exclusions || '';
    var priceOnReq = !data.price || data.price === 0;
    document.getElementById('tourPriceOnRequest').checked = priceOnReq;
    document.getElementById('tourPriceRow').style.display = priceOnReq ? 'none' : '';
    setPrice('tourPrice', priceOnReq ? 0 : (data.price || 100));
    document.getElementById('tourExistingImages').value = JSON.stringify(data.images || []);
    document.getElementById('tourExistingImageIds').value = JSON.stringify(data.image_id || []);

    // Highlights
    document.getElementById('highlightsList').innerHTML = '';
    highlightIndex = 0;
    var highlights = data.highlights || [];
    if (highlights.length === 0) {
        addHighlightRow();
    } else {
        highlights.forEach(function (h) { addHighlightRow(h); });
    }

    // Existing images preview
    clearImgArea('tourImagesArea', 'tourImgSlot');
    (data.images || []).forEach(function (url, i) {
        insertImgPreview('tourImagesArea', 'tourImgSlot', url, i, 'tour');
    });

    document.getElementById('tourModal').style.display = 'flex';
}

// ── Car modal (add) ──
function openCarModal() {
    document.getElementById('carModalTitle').textContent = 'Add Service';
    document.getElementById('carForm').action = '{{ route("services.store") }}';
    document.getElementById('carMethod').value = 'POST';
    document.getElementById('carName').value = '';
    document.getElementById('carYear').value = new Date().getFullYear();
    document.getElementById('carTransmission').value = '';
    document.getElementById('carFuelType').value = '';
    document.getElementById('carAvailable').checked = true;
    document.getElementById('carExistingImages').value = '[]';
    document.getElementById('carExistingImageIds').value = '[]';
    clearImgArea('carImagesArea', 'carImgSlot');
    setPrice('carPrice', 100);
    document.getElementById('carModal').style.display = 'flex';
}

// ── Car modal (edit) ──
function loadCarModal(data) {
    document.getElementById('carModalTitle').textContent = 'Edit Service';
    document.getElementById('carForm').action = '/services/' + data.id;
    document.getElementById('carMethod').value = 'PUT';
    document.getElementById('carName').value = data.car_name || '';
    document.getElementById('carYear').value = data.year || new Date().getFullYear();
    document.getElementById('carTransmission').value = data.transmission || '';
    document.getElementById('carFuelType').value = data.fuel_type || '';
    document.getElementById('carAvailable').checked = data.available || false;
    document.getElementById('carExistingImages').value = JSON.stringify(data.images || []);
    document.getElementById('carExistingImageIds').value = JSON.stringify(data.image_id || []);
    setPrice('carPrice', data.price || 100);

    clearImgArea('carImagesArea', 'carImgSlot');
    (data.images || []).forEach(function (url, i) {
        insertImgPreview('carImagesArea', 'carImgSlot', url, i, 'car');
    });

    document.getElementById('carModal').style.display = 'flex';
}

// ── Highlights ──
function addHighlightRow(h) {
    h = h || {};
    var idx = highlightIndex++;
    var row = document.createElement('div');
    row.className = 'highlight-row';
    row.dataset.idx = idx;

    var imgHtml = h.image
        ? '<div class="highlight-img-wrap"><img src="' + h.image + '" class="highlight-thumb"><button type="button" class="highlight-img-remove" onclick="removeHighlightImg(this, ' + idx + ')">&times;</button><input type="hidden" name="highlight_existing_img_' + idx + '" value="' + h.image + '"></div>'
        : '<button type="button" class="btn-add-img" onclick="triggerHighlightImg(this, ' + idx + ')"><svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Add Image<input type="file" name="highlight_image_' + idx + '" accept="image/*" style="display:none" onchange="previewHighlightImg(this, ' + idx + ')"></button>';

    row.innerHTML =
        '<input type="text" name="highlight_title[]" placeholder="Highlight Title" value="' + (h.title || '') + '">' +
        '<input type="text" name="highlight_desc[]" placeholder="Highlights Description" value="' + (h.description || '') + '">' +
        imgHtml +
        '<button type="button" class="btn-del-row" onclick="this.closest(\'.highlight-row\').remove()" title="Remove">&#128465;</button>';

    document.getElementById('highlightsList').appendChild(row);
}

function triggerHighlightImg(btn, idx) {
    btn.querySelector('input[type=file]').click();
}

function previewHighlightImg(input, idx) {
    if (!input.files || !input.files[0]) return;
    var reader = new FileReader();
    reader.onload = function (e) {
        var btn = input.closest('.btn-add-img');
        var wrap = document.createElement('div');
        wrap.className = 'highlight-img-wrap';
        wrap.innerHTML = '<img src="' + e.target.result + '" class="highlight-thumb"><button type="button" class="highlight-img-remove" onclick="removeHighlightImg(this, ' + idx + ')">&times;</button>';
        input.name = 'highlight_image_' + idx;
        wrap.appendChild(input);
        btn.replaceWith(wrap);
    };
    reader.readAsDataURL(input.files[0]);
}

function removeHighlightImg(btn, idx) {
    var wrap = btn.closest('.highlight-img-wrap');
    var row  = wrap.closest('.highlight-row');
    var newBtn = document.createElement('button');
    newBtn.type = 'button';
    newBtn.className = 'btn-add-img';
    newBtn.onclick = function () { triggerHighlightImg(newBtn, idx); };
    newBtn.innerHTML = '<svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Add Image<input type="file" name="highlight_image_' + idx + '" accept="image/*" style="display:none" onchange="previewHighlightImg(this, ' + idx + ')">';
    wrap.replaceWith(newBtn);
}

// ── Image upload area ──
function handleTourImages(input) { appendImgPreviews('tourImagesArea', 'tourImgSlot', input, 'tour'); }
function handleCarImages(input)  { appendImgPreviews('carImagesArea', 'carImgSlot', input, 'car'); }

function appendImgPreviews(areaId, slotId, input, prefix) {
    if (!input.files || !input.files.length) return;

    // Capture the newly selected files before we modify anything
    var newFiles = Array.from(input.files);

    // Accumulate: merge previously accumulated + new picks into the input
    var dt = new DataTransfer();
    if (input._accumulated) {
        input._accumulated.forEach(function (f) { dt.items.add(f); });
    }
    newFiles.forEach(function (f) { dt.items.add(f); });
    input._accumulated = Array.from(dt.files);
    try { input.files = dt.files; } catch (e) {}

    // Show previews only for the newly selected files
    newFiles.forEach(function (file) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var area = document.getElementById(areaId);
            var slot = document.getElementById(slotId);
            var wrap = document.createElement('div');
            wrap.className = 'img-preview-wrap';
            var img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'img-preview';
            var rmBtn = document.createElement('button');
            rmBtn.type = 'button';
            rmBtn.className = 'img-preview-remove';
            rmBtn.innerHTML = '&times;';
            rmBtn.onclick = function () {
                wrap.remove();
                // Remove file from accumulated list by matching name+size
                if (input._accumulated) {
                    input._accumulated = input._accumulated.filter(function (f) {
                        return !(f.name === file.name && f.size === file.size);
                    });
                    var dt2 = new DataTransfer();
                    input._accumulated.forEach(function (f) { dt2.items.add(f); });
                    try { input.files = dt2.files; } catch (e) {}
                }
            };
            wrap.appendChild(img);
            wrap.appendChild(rmBtn);
            area.insertBefore(wrap, slot);
        };
        reader.readAsDataURL(file);
    });
}

function insertImgPreview(areaId, slotId, url, idx, prefix) {
    var area = document.getElementById(areaId);
    var slot = document.getElementById(slotId);
    var wrap = document.createElement('div');
    wrap.className = 'img-preview-wrap';
    var img = document.createElement('img');
    img.src = url; img.className = 'img-preview';
    var rmBtn = document.createElement('button');
    rmBtn.type = 'button'; rmBtn.className = 'img-preview-remove'; rmBtn.innerHTML = '&times;';
    rmBtn.onclick = function () {
        wrap.remove();
        var existing = JSON.parse(document.getElementById(prefix + 'ExistingImages').value || '[]');
        existing.splice(idx, 1);
        document.getElementById(prefix + 'ExistingImages').value = JSON.stringify(existing);
    };
    wrap.appendChild(img); wrap.appendChild(rmBtn);
    area.insertBefore(wrap, slot);
}

function clearImgArea(areaId, slotId) {
    var area = document.getElementById(areaId);
    var slot = document.getElementById(slotId);
    Array.from(area.querySelectorAll('.img-preview-wrap')).forEach(el => el.remove());
}
</script>
@endsection

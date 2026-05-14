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

    /* Edit Modal */
    .adm-modal-overlay { position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,.45); display:flex; align-items:center; justify-content:center; z-index:2000; }
    .adm-modal { background:#fff; border-radius:16px; padding:28px; max-width:520px; width:90%; max-height:90vh; overflow-y:auto; }
    .adm-modal-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
    .adm-modal-head h3 { font-size:18px; font-weight:700; color:#1a1a2e; margin:0; }
    .adm-modal-close { background:none; border:none; font-size:22px; cursor:pointer; color:#aaa; }
    .adm-modal-close:hover { color:#555; }
    .adm-form-group { margin-bottom:16px; }
    .adm-form-group label { display:block; font-size:13px; font-weight:600; color:#1a1a2e; margin-bottom:6px; }
    .adm-form-group input, .adm-form-group textarea { width:100%; padding:10px 14px; border:1px solid #e0e0e0; border-radius:8px; font-size:14px; outline:none; font-family:inherit; resize:vertical; }
    .adm-form-group input:focus, .adm-form-group textarea:focus { border-color:#2563EB; }
    .adm-modal-foot { display:flex; gap:8px; justify-content:flex-end; margin-top:20px; }
    .btn-save { background:#0D1F35; color:#fff; border:none; padding:10px 24px; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer; }
    .btn-save:hover { background:#1e3a5f; }
    .btn-modal-cancel { background:#f0f0f0; color:#555; border:none; padding:10px 20px; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer; }
    .btn-modal-cancel:hover { background:#e0e0e0; }

    @media(max-width:767px) {
        .svc-toolbar {
            align-items: stretch;
        }

        .svc-tabbar {
            width: 100%;
        }
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
                    <button class="svc-tab" data-pane="transfers">Transfers</button>
                    <button class="svc-tab" data-pane="events">Event Planning</button>
                </div>
            </div>
            <button class="admin-primary-btn" type="button" onclick="document.getElementById('newServiceModal').style.display='flex'">
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
                    <img src="{{ $tourImg }}" alt="{{ $tour->title }}" onerror="this.src='{{ asset('assets/images/backgrounds/bg_11.jpg') }}'">
                    <div class="svc-card-body">
                        <div class="svc-card-head">
                            <div class="svc-card-title">{{ $tour->title }}</div>
                            <div class="svc-card-price">${{ number_format($tour->price ?? 100) }} per person</div>
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
                        <img src="{{ $vImg }}" alt="{{ $vehicle->brand->name ?? '' }} {{ $vehicle->model->name ?? '' }}" onerror="this.src='{{ asset('assets/images/vehicles/not_found.png') }}'">
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

        {{-- Transfers --}}
        <div class="tab-pane" id="pane-transfers">
            @if($transfers->count())
                <div class="svc-grid">
                    @foreach($transfers as $transfer)
                    <div class="svc-card">
                        <img src="{{ asset('assets/images/backgrounds/bg_15.jpg') }}" alt="{{ $transfer->destination }} Transfer">
                        <div class="svc-card-body">
                            <div class="svc-card-head">
                                <div class="svc-card-title">{{ $transfer->destination }} Transfer</div>
                                <div class="svc-card-price">${{ number_format($transfer->price) }} per trip</div>
                            </div>
                            <p class="svc-card-desc">{{ $transfer->message ?? 'Professional transfer service with comfortable vehicles and reliable drivers.' }}</p>
                            <div class="svc-card-actions">
                                <button class="btn-edit-svc" data-type="transfer" data-id="{{ $transfer->id }}">Edit</button>
                                <button class="btn-del-svc"  data-type="transfer" data-id="{{ $transfer->id }}">Delete</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="no-services"><i class="fas fa-exchange-alt"></i>No transfers available.</div>
            @endif
        </div>

        {{-- Event Planning --}}
        <div class="tab-pane" id="pane-events">
            @if($events->count())
                <div class="svc-grid">
                    @foreach($events as $event)
                    <div class="svc-card">
                        <img src="{{ asset('assets/images/backgrounds/bg_04.jpg') }}" alt="{{ $event->title }}">
                        <div class="svc-card-body">
                            <div class="svc-card-head">
                                <div class="svc-card-title">{{ $event->title }}</div>
                                <div class="svc-card-price">From ${{ number_format($event->price) }}</div>
                            </div>
                            <p class="svc-card-desc">{{ $event->description ?? 'Complete event planning from concept to execution. We handle everything for your special occasions.' }}</p>
                            <div class="svc-card-actions">
                                <button class="btn-edit-svc" data-type="event" data-id="{{ $event->id }}">Edit</button>
                                <button class="btn-del-svc"  data-type="event" data-id="{{ $event->id }}">Delete</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="no-services"><i class="fas fa-calendar-check"></i>No events available.</div>
            @endif
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="adm-modal-overlay" id="editServiceModal" style="display:none;">
        <div class="adm-modal">
            <div class="adm-modal-head">
                <h3>Edit Service</h3>
                <button class="adm-modal-close" onclick="document.getElementById('editServiceModal').style.display='none'">&times;</button>
            </div>
            <form action="{{ route('services.update', '') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="editServiceId">
                <div class="adm-form-group">
                    <label>Service Type</label>
                    <select name="service_type" id="editServiceType" required style="width:100%;padding:10px 14px;border:1px solid #e0e0e0;border-radius:8px;font-size:14px;outline:none;">
                        <option value="tour">Tour & Travel</option>
                        <option value="car">Car Rental</option>
                        <option value="transfer">Transfer</option>
                        <option value="event">Event Planning</option>
                    </select>
                </div>
                <div class="adm-form-group">
                    <label>Title</label>
                    <input type="text" name="title" id="editTitle" placeholder="Service title" required>
                </div>
                <div class="adm-form-group">
                    <label>Price</label>
                    <input type="number" name="price" id="editPrice" placeholder="Price" step="0.01" required>
                </div>
                <div class="adm-form-group">
                    <label>Description</label>
                    <textarea name="description" id="editDesc" rows="3" placeholder="Description" required></textarea>
                </div>
                <div class="adm-modal-foot">
                    <button type="button" class="btn-modal-cancel" onclick="document.getElementById('editServiceModal').style.display='none'">Cancel</button>
                    <button type="submit" class="btn-save">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    {{-- New Service Modal --}}
    <div class="adm-modal-overlay" id="newServiceModal" style="display:none;">
        <div class="adm-modal">
            <div class="adm-modal-head">
                <h3>New Service</h3>
                <button class="adm-modal-close" onclick="document.getElementById('newServiceModal').style.display='none'">&times;</button>
            </div>
            <form action="{{ route('services.store') }}" method="POST">
                @csrf
                <div class="adm-form-group">
                    <label>Service Type</label>
                    <select name="service_type" required style="width:100%;padding:10px 14px;border:1px solid #e0e0e0;border-radius:8px;font-size:14px;outline:none;">
                        <option value="tour">Tours & Travel</option>
                        <option value="car">Car Rental</option>
                        <option value="transfer">Transfers</option>
                        <option value="event">Event Planning</option>
                    </select>
                </div>
                <div class="adm-form-group">
                    <label>Title</label>
                    <input type="text" name="title" placeholder="Service title" required>
                </div>
                <div class="adm-form-group">
                    <label>Price</label>
                    <input type="number" name="price" placeholder="Price" step="0.01" required>
                </div>
                <div class="adm-form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3" placeholder="Description" required></textarea>
                </div>
                <div class="adm-modal-foot">
                    <button type="button" class="btn-modal-cancel" onclick="document.getElementById('newServiceModal').style.display='none'">Cancel</button>
                    <button type="submit" class="btn-save">Create</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.svc-tab').forEach(function(tab) {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.svc-tab').forEach(function(t){ t.classList.remove('active'); });
            tab.classList.add('active');
            document.querySelectorAll('.tab-pane').forEach(function(p){ p.classList.remove('active'); });
            document.getElementById('pane-' + tab.dataset.pane).classList.add('active');
        });
    });

    var si = document.getElementById('searchInput');
    if (si) si.addEventListener('input', function() {
        var val = si.value.toLowerCase();
        document.querySelectorAll('.svc-card').forEach(function(card) {
            card.style.display = card.textContent.toLowerCase().includes(val) ? '' : 'none';
        });
    });

    document.querySelectorAll('.btn-edit-svc').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const type = this.dataset.type;
            const id = this.dataset.id;
            
            // Set service ID for edit form
            document.getElementById('editServiceId').value = id;
            
            // Populate modal fields based on service type
            if (type === 'tour') {
                document.getElementById('editServiceType').value = 'tour';
            } else if (type === 'car') {
                document.getElementById('editServiceType').value = 'car';
            } else if (type === 'transfer') {
                document.getElementById('editServiceType').value = 'transfer';
            } else if (type === 'event') {
                document.getElementById('editServiceType').value = 'event';
            }
            
            document.getElementById('editServiceModal').style.display = 'flex';
        });
    });

    document.querySelectorAll('.btn-del-svc').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (confirm('Delete this service?')) {
                const id = this.dataset.id;
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/services/${id}`;
                
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                
                form.appendChild(csrfInput);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
</script>
@endsection

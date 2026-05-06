@extends('layouts.app')

@section('title')
    Services
@endsection

@section('css')
<style>
    .adm-topbar { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:14px; }
    .adm-topbar h1 { font-size:28px; font-weight:800; color:#1a1a2e; margin:0; }
    .adm-topbar-right { display:flex; align-items:center; gap:12px; }
    .adm-search { display:flex; align-items:center; gap:10px; background:#fff; border:1px solid #e8e8e8; border-radius:10px; padding:9px 16px; width:260px; }
    .adm-search i { color:#bbb; font-size:14px; }
    .adm-search input { border:none; outline:none; background:transparent; font-size:14px; color:#333; width:100%; }
    .adm-search input::placeholder { color:#bbb; }
    .adm-bell { width:40px; height:40px; border-radius:50%; background:#fff; border:1px solid #e8e8e8; display:flex; align-items:center; justify-content:center; color:#666; cursor:pointer; position:relative; }
    .adm-bell-dot { position:absolute; top:9px; right:9px; width:8px; height:8px; border-radius:50%; background:#e74c3c; border:2px solid #fff; }
    .adm-avatar { width:40px; height:40px; border-radius:50%; background:#1a1a2e; color:#fff; display:flex; align-items:center; justify-content:center; font-size:15px; font-weight:700; cursor:pointer; }
    .adm-new-btn { background:#0D1F35; color:#fff; border:none; border-radius:10px; padding:10px 20px; font-size:14px; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:8px; white-space:nowrap; transition:background .2s; }
    .adm-new-btn:hover { background:#1e3a5f; }

    /* Tab bar */
    .svc-tabbar { display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid #e8e8e8; margin-bottom:28px; }
    .svc-tabs { display:flex; align-items:center; gap:0; }
    .svc-tab { padding:12px 20px; font-size:14px; font-weight:500; color:#888; cursor:pointer; border:none; background:none; border-bottom:2px solid transparent; margin-bottom:-1px; transition:color .2s; white-space:nowrap; }
    .svc-tab.active { color:#1a1a2e; border-bottom-color:#1a1a2e; font-weight:600; }
    .svc-tab:hover:not(.active) { color:#555; }

    /* Service grid */
    .svc-grid { display:grid; grid-template-columns:repeat(3, 1fr); gap:20px; }
    @media(max-width:900px) { .svc-grid { grid-template-columns:repeat(2,1fr); } }
    @media(max-width:600px) { .svc-grid { grid-template-columns:1fr; } }

    .svc-card { background:#fff; border-radius:14px; overflow:hidden; box-shadow:0 1px 8px rgba(0,0,0,.06); transition:box-shadow .2s; }
    .svc-card:hover { box-shadow:0 4px 20px rgba(0,0,0,.1); }
    .svc-card img { width:100%; height:180px; object-fit:cover; display:block; }
    .svc-card-body { padding:16px 18px 18px; }
    .svc-card-head { display:flex; align-items:flex-start; justify-content:space-between; gap:10px; margin-bottom:8px; }
    .svc-card-title { font-size:15px; font-weight:700; color:#1a1a2e; }
    .svc-card-price { font-size:13px; font-weight:600; color:#4F9DE8; white-space:nowrap; }
    .svc-card-desc { font-size:13px; color:#888; line-height:1.5; margin-bottom:16px; }
    .svc-card-actions { display:flex; gap:10px; }
    .btn-edit-svc { flex:1; background:#0D1F35; color:#fff; border:none; border-radius:8px; padding:10px 0; font-size:13px; font-weight:600; cursor:pointer; transition:background .2s; }
    .btn-edit-svc:hover { background:#1e3a5f; }
    .btn-del-svc { flex:1; background:#fff; color:#0D1F35; border:1.5px solid #0D1F35; border-radius:8px; padding:10px 0; font-size:13px; font-weight:600; cursor:pointer; transition:background .2s,color .2s; }
    .btn-del-svc:hover { background:#0D1F35; color:#fff; }

    .no-services { text-align:center; padding:48px 20px; color:#bbb; }
    .no-services i { font-size:32px; display:block; margin-bottom:12px; }

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
</style>
@endsection

@section('content')

    <div class="adm-topbar">
        <h1>Services</h1>
        <div class="adm-topbar-right">
            <div class="adm-search">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search..." id="searchInput">
            </div>
            <div class="adm-bell">
                <i class="fas fa-bell"></i>
                <span class="adm-bell-dot"></span>
            </div>
            <div class="adm-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
            <button class="adm-new-btn" onclick="document.getElementById('newServiceModal').style.display='flex'">
                <i class="fas fa-plus"></i> New Service
            </button>
        </div>
    </div>

    {{-- Tab bar --}}
    <div class="svc-tabbar">
        <div class="svc-tabs">
            <button class="svc-tab active" data-pane="tours">Tours &amp; Travel</button>
            <button class="svc-tab" data-pane="cars">Car Rental</button>
            <button class="svc-tab" data-pane="transfers">Transfers</button>
            <button class="svc-tab" data-pane="events">Event Planning</button>
        </div>
    </div>

    {{-- Tours & Travel --}}
    <div class="tab-pane active" id="pane-tours">
        @if($tours->count())
        <div class="svc-grid">
            @foreach($tours as $tour)
            <div class="svc-card">
                <img src="{{ asset('assets/images/backgrounds/bg_11.jpg') }}" alt="{{ $tour->title }}">
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
            <div class="svc-card">
                <img src="{{ asset('assets/images/vehicles/not_found.png') }}" alt="{{ $vehicle->brand->name }} {{ $vehicle->model->name }}">
                <div class="svc-card-body">
                    <div class="svc-card-head">
                        <div class="svc-card-title">{{ $vehicle->brand->name }} {{ $vehicle->model->name }}</div>
                        <div class="svc-card-price">${{ number_format($vehicle->price ?? 50) }} per day</div>
                    </div>
                    <p class="svc-card-desc">{{ Str::limit($vehicle->description ?? 'Reliable and comfortable vehicles for all your transportation needs. Well-maintained fleet with professional drivers available.', 150) }}</p>
                    <div class="svc-card-actions">
                        <button class="btn-edit-svc" data-type="car" data-id="{{ $vehicle->id }}">Edit</button>
                        <button class="btn-del-svc"  data-type="car" data-id="{{ $vehicle->id }}">Delete</button>
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

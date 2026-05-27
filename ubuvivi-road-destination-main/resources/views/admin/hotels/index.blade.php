@extends('layouts.app')
@section('title') Hotels @endsection

@section('css')
<style>
    .hotels-page { display:flex; flex-direction:column; gap:22px; width:100%; }
    .adm-flash { padding:12px 18px; border-radius:10px; font-size:14px; margin-bottom:4px; }
    .adm-flash.success { background:#f0fdf4; border:1px solid #bbf7d0; color:#15803d; }
    .adm-flash.error   { background:#fef2f2; border:1px solid #fecaca; color:#dc2626; }

    .hotels-toolbar { display:flex; align-items:center; justify-content:space-between; gap:14px; flex-wrap:wrap; }

    .hotels-grid { display:grid; grid-template-columns:repeat(3, 1fr); gap:18px; }
    .hotel-adm-card { background:#fff; border-radius:14px; border:1px solid #e4e8f0; box-shadow:0 2px 12px rgba(13,31,53,.05); overflow:hidden; display:flex; flex-direction:column; }
    .hotel-adm-img { width:100%; height:180px; object-fit:cover; background:#f0f2f7; display:block; }
    .hotel-adm-img-placeholder { width:100%; height:180px; background:#f0f2f7; display:flex; align-items:center; justify-content:center; color:#bbb; font-size:32px; }
    .hotel-adm-body { padding:16px 18px 18px; flex:1; display:flex; flex-direction:column; }
    .hotel-adm-name { font-size:16px; font-weight:700; color:#182b39; margin-bottom:3px; }
    .hotel-adm-loc  { font-size:13px; color:#888; margin-bottom:8px; }
    .hotel-adm-stars { color:#f5c518; font-size:12px; margin-bottom:6px; }
    .hotel-adm-price { font-size:13px; color:#0D1F35; font-weight:600; margin-bottom:10px; }
    .hotel-adm-tags { display:flex; gap:6px; flex-wrap:wrap; margin-bottom:12px; }
    .hotel-adm-tag  { background:#f0f2f7; color:#555; padding:3px 9px; border-radius:50px; font-size:11px; }
    .hotel-adm-foot { display:flex; gap:8px; margin-top:auto; }
    .btn-edit-hotel { flex:1; background:#0f5f86; color:#fff; border:none; border-radius:7px; padding:7px 12px; font-size:12px; font-weight:600; cursor:pointer; }
    .btn-edit-hotel:hover { background:#0c4d6d; }
    .btn-del-hotel  { background:#fff; color:#e74c3c; border:1px solid #e74c3c; border-radius:7px; padding:7px 12px; font-size:12px; font-weight:600; cursor:pointer; }
    .btn-del-hotel:hover  { background:#e74c3c; color:#fff; }

    .no-hotels { text-align:center; padding:80px 20px; color:#bbb; background:#fff; border-radius:14px; border:1px solid #e4e8f0; }
    .no-hotels i { font-size:40px; display:block; margin-bottom:12px; }

    /* ── Shared Modal ── */
    .adm-modal-overlay { position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,.48); display:flex; align-items:center; justify-content:center; z-index:2000; padding:16px; }
    .adm-modal { background:#fff; border-radius:16px; padding:28px 32px; max-width:700px; width:100%; max-height:92vh; overflow-y:auto; }
    .adm-modal-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:22px; }
    .adm-modal-head h3 { font-size:18px; font-weight:700; color:#1a1a2e; margin:0; }
    .adm-modal-close { background:none; border:none; font-size:22px; cursor:pointer; color:#aaa; }
    .adm-form-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px; }
    .adm-form-row.single { grid-template-columns:1fr; }
    .adm-form-group { display:flex; flex-direction:column; }
    .adm-form-group label { font-size:13px; font-weight:600; color:#444; margin-bottom:6px; }
    .adm-form-group input,
    .adm-form-group textarea,
    .adm-form-group select { padding:10px 14px; border:1.5px solid #e0e0e0; border-radius:8px; font-size:14px; outline:none; font-family:inherit; background:#fff; color:#1a1a2e; }
    .adm-form-group input:focus,
    .adm-form-group textarea:focus,
    .adm-form-group select:focus { border-color:#0D1F35; }
    .adm-form-group textarea { resize:vertical; min-height:80px; }
    .adm-check-row { display:flex; align-items:center; gap:8px; font-size:14px; color:#444; margin-bottom:16px; }
    .adm-check-row input[type=checkbox] { width:16px; height:16px; accent-color:#0D1F35; cursor:pointer; }
    .img-preview-strip { display:flex; gap:8px; flex-wrap:wrap; margin-top:8px; }
    .img-preview-strip img { width:80px; height:64px; object-fit:cover; border-radius:6px; border:1px solid #e0e0e0; }
    .adm-modal-foot { display:flex; justify-content:flex-end; border-top:1px solid #f0f0f0; padding-top:18px; margin-top:8px; }
    .btn-save { background:#0D1F35; color:#fff; border:none; padding:11px 28px; border-radius:8px; font-size:14px; font-weight:600; cursor:pointer; }
    .btn-save:hover { background:#1e3a5f; }

    @media (max-width: 991px) { .hotels-grid { grid-template-columns:repeat(2, 1fr); } }
    @media (max-width: 767px) {
        .hotels-grid { grid-template-columns:1fr; }
        .hotels-toolbar { flex-direction:column; align-items:flex-start; }
        .hotels-toolbar .admin-primary-btn { width:100%; justify-content:center; }
        .adm-form-row { grid-template-columns:1fr !important; }
        .adm-modal-overlay { padding:0; align-items:flex-end; }
        .adm-modal { border-radius:18px 18px 0 0; padding:22px 18px 28px; max-height:92vh; width:100%; max-width:100%; }
        .adm-modal-foot { justify-content:stretch; }
        .btn-save { width:100%; text-align:center; }
    }
</style>
@endsection

@section('content')
<div class="hotels-page">

    @include('layouts.partials.admin_topbar', ['title' => 'Hotels', 'searchInputId' => 'hotelSearch', 'searchAriaLabel' => 'Search hotels'])

    @if(session('success'))
        <div class="adm-flash success"><i class="fas fa-check-circle" style="margin-right:6px"></i>{{ session('success') }}</div>
    @endif

    <div class="hotels-toolbar">
        <span style="font-size:14px;color:#666;">{{ $hotels->count() }} hotel{{ $hotels->count() !== 1 ? 's' : '' }}</span>
        <button class="admin-primary-btn" type="button" onclick="openAddModal()">
            <i class="fas fa-plus"></i> Add Hotel
        </button>
    </div>

    @if($hotels->count())
    <div class="hotels-grid" id="hotelGrid">
        @for($sk=0;$sk<3;$sk++)
        <div class="skel-card-wrap">
            <div class="skel-card">
                <div class="skel skel-img"></div>
                <div class="skel-body" style="padding:16px 18px 18px;">
                    <div class="skel skel-line" style="width:75%;margin-bottom:8px;"></div>
                    <div class="skel skel-line short" style="margin-bottom:12px;"></div>
                    <div class="skel skel-line" style="width:50%;margin-bottom:6px;"></div>
                    <div class="skel skel-btn" style="width:80px;height:28px;border-radius:7px;margin-top:18px;"></div>
                </div>
            </div>
        </div>
        @endfor
        @foreach($hotels as $hotel)
        <div class="hotel-adm-card hotel-item" data-searchable data-name="{{ strtolower($hotel->name) }} {{ strtolower($hotel->location) }}">
            @if($hotel->cover_image)
                <img src="{{ $hotel->cover_image }}" alt="{{ $hotel->name }}" class="hotel-adm-img">
            @else
                <div class="hotel-adm-img-placeholder"><i class="fas fa-hotel"></i></div>
            @endif
            <div class="hotel-adm-body">
                <div class="hotel-adm-name">{{ $hotel->name }}</div>
                <div class="hotel-adm-loc"><i class="fas fa-map-marker-alt" style="color:#C85A2A;margin-right:4px;font-size:11px;"></i>{{ $hotel->location }}</div>
                <div class="hotel-adm-stars">
                    @for($i = 0; $i < $hotel->stars; $i++) <i class="fas fa-star"></i> @endfor
                </div>
                @if($hotel->price_per_night)
                    <div class="hotel-adm-price">${{ number_format($hotel->price_per_night, 0) }} / night</div>
                @endif
                <div class="hotel-adm-tags">
                    @foreach(array_slice($hotel->amenities ?? [], 0, 4) as $am)
                        <span class="hotel-adm-tag">{{ $am }}</span>
                    @endforeach
                    @if(!$hotel->available)
                        <span class="hotel-adm-tag" style="background:#fce4e4;color:#c62828;">Unavailable</span>
                    @endif
                </div>
                <div class="hotel-adm-foot">
                    <button class="btn-edit-hotel" onclick="openEditModal({{ $hotel->id }})">Edit</button>
                    <button class="btn-del-hotel"  onclick="deleteHotel({{ $hotel->id }})">Delete</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="no-hotels">
        <i class="fas fa-hotel"></i>
        No hotels added yet. Click "Add Hotel" to get started.
    </div>
    @endif
</div>

{{-- ── Add Modal ── --}}
<div class="adm-modal-overlay" id="addModal" style="display:none;">
    <div class="adm-modal">
        <div class="adm-modal-head">
            <h3>Add Hotel</h3>
            <button class="adm-modal-close" onclick="document.getElementById('addModal').style.display='none'">&times;</button>
        </div>
        <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="adm-form-row">
                <div class="adm-form-group" style="grid-column:1/-1">
                    <label>Hotel Name <span style="color:#e74c3c">*</span></label>
                    <input type="text" name="name" placeholder="e.g. Kigali Marriott Hotel" required>
                </div>
            </div>
            <div class="adm-form-row">
                <div class="adm-form-group">
                    <label>Location <span style="color:#e74c3c">*</span></label>
                    <input type="text" name="location" placeholder="e.g. KN 3 Ave, Kigali" required>
                </div>
                <div class="adm-form-group">
                    <label>Stars (1–5) <span style="color:#e74c3c">*</span></label>
                    <select name="stars" required>
                        @for($s=5;$s>=1;$s--)<option value="{{ $s }}">{{ $s }} Star{{ $s>1?'s':'' }}</option>@endfor
                    </select>
                </div>
            </div>
            <div class="adm-form-row">
                <div class="adm-form-group">
                    <label>Price per Night (USD)</label>
                    <input type="number" name="price_per_night" placeholder="0.00" min="0" step="0.01">
                </div>
                <div class="adm-form-group">
                    <label>Amenities <span style="font-weight:400;color:#999">(comma-separated)</span></label>
                    <input type="text" name="amenities" placeholder="Pool, Wi-Fi, Restaurant, Spa">
                </div>
            </div>
            <div class="adm-form-row single">
                <div class="adm-form-group">
                    <label>Description</label>
                    <textarea name="description" placeholder="Brief description of the hotel..."></textarea>
                </div>
            </div>
            <div class="adm-form-row single">
                <div class="adm-form-group">
                    <label>Photos</label>
                    <input type="file" name="images[]" accept="image/*" multiple onchange="previewHotelImgs(this,'addImgPreview')">
                    <div class="img-preview-strip" id="addImgPreview"></div>
                </div>
            </div>
            <div class="adm-check-row">
                <input type="checkbox" name="available" id="addAvail" checked>
                <label for="addAvail">Available for booking</label>
            </div>
            <div class="adm-modal-foot">
                <button type="submit" class="btn-save">Add Hotel</button>
            </div>
        </form>
    </div>
</div>

{{-- ── Edit Modal ── --}}
<div class="adm-modal-overlay" id="editModal" style="display:none;">
    <div class="adm-modal">
        <div class="adm-modal-head">
            <h3>Edit Hotel</h3>
            <button class="adm-modal-close" onclick="document.getElementById('editModal').style.display='none'">&times;</button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="adm-form-row">
                <div class="adm-form-group" style="grid-column:1/-1">
                    <label>Hotel Name <span style="color:#e74c3c">*</span></label>
                    <input type="text" name="name" id="editName" required>
                </div>
            </div>
            <div class="adm-form-row">
                <div class="adm-form-group">
                    <label>Location <span style="color:#e74c3c">*</span></label>
                    <input type="text" name="location" id="editLocation" required>
                </div>
                <div class="adm-form-group">
                    <label>Stars</label>
                    <select name="stars" id="editStars">
                        @for($s=5;$s>=1;$s--)<option value="{{ $s }}">{{ $s }} Star{{ $s>1?'s':'' }}</option>@endfor
                    </select>
                </div>
            </div>
            <div class="adm-form-row">
                <div class="adm-form-group">
                    <label>Price per Night (USD)</label>
                    <input type="number" name="price_per_night" id="editPrice" min="0" step="0.01">
                </div>
                <div class="adm-form-group">
                    <label>Amenities</label>
                    <input type="text" name="amenities" id="editAmenities">
                </div>
            </div>
            <div class="adm-form-row single">
                <div class="adm-form-group">
                    <label>Description</label>
                    <textarea name="description" id="editDescription"></textarea>
                </div>
            </div>
            <div class="adm-form-row single">
                <div class="adm-form-group">
                    <label>Add More Photos</label>
                    <input type="file" name="images[]" accept="image/*" multiple onchange="previewHotelImgs(this,'editImgPreview')">
                    <div class="img-preview-strip" id="editCurrentImgs"></div>
                    <div class="img-preview-strip" id="editImgPreview"></div>
                </div>
            </div>
            <div class="adm-check-row">
                <input type="checkbox" name="available" id="editAvail">
                <label for="editAvail">Available for booking</label>
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
function openAddModal() { document.getElementById('addModal').style.display = 'flex'; }

function openEditModal(id) {
    fetch('/admin/hotels/' + id + '/data')
        .then(function(r){ return r.json(); })
        .then(function(d) {
            document.getElementById('editForm').action = '/admin/hotels/' + id;
            document.getElementById('editName').value      = d.name || '';
            document.getElementById('editLocation').value  = d.location || '';
            document.getElementById('editStars').value     = d.stars || 3;
            document.getElementById('editPrice').value     = d.price_per_night || '';
            document.getElementById('editAmenities').value = d.amenities || '';
            document.getElementById('editDescription').value = d.description || '';
            document.getElementById('editAvail').checked   = d.available;
            var cur = document.getElementById('editCurrentImgs');
            cur.innerHTML = (d.images || []).map(function(img) {
                return '<img src="' + img + '" alt="hotel">';
            }).join('');
            document.getElementById('editImgPreview').innerHTML = '';
            document.getElementById('editModal').style.display = 'flex';
        });
}

function deleteHotel(id) {
    if (!confirm('Delete this hotel? This cannot be undone.')) return;
    var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '/admin/hotels/' + id;
    [['_token', csrf], ['_method', 'DELETE']].forEach(function(p) {
        var inp = document.createElement('input');
        inp.type = 'hidden'; inp.name = p[0]; inp.value = p[1];
        form.appendChild(inp);
    });
    document.body.appendChild(form);
    form.submit();
}

function previewHotelImgs(input, previewId) {
    var container = document.getElementById(previewId);
    container.innerHTML = '';
    if (!input.files) return;
    Array.from(input.files).forEach(function(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.createElement('img');
            img.src = e.target.result;
            container.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    var hotelSearch = document.getElementById('hotelSearch');
    if (hotelSearch) {
        hotelSearch.addEventListener('input', function () {
            var q = hotelSearch.value.trim().toLowerCase();
            document.querySelectorAll('.hotel-item').forEach(function (card) {
                card.style.display = card.textContent.toLowerCase().includes(q) ? '' : 'none';
            });
        });
    }
});
</script>
@endsection

@extends('layouts.app')
@section('title') Destinations @endsection

@section('css')
<style>
    .dest-page { display:flex; flex-direction:column; gap:22px; width:100%; }
    .adm-flash { padding:12px 18px; border-radius:10px; font-size:14px; margin-bottom:4px; }
    .adm-flash.success { background:#f0fdf4; border:1px solid #bbf7d0; color:#15803d; }
    .adm-flash.error   { background:#fef2f2; border:1px solid #fecaca; color:#dc2626; }

    .dest-toolbar { display:flex; align-items:center; justify-content:space-between; gap:14px; flex-wrap:wrap; }
    .dest-hint { font-size:13px; color:#7a8896; background:#f4f7fb; border:1px solid #e1e8f0; border-radius:10px; padding:12px 16px; }

    .dest-grid { display:grid; grid-template-columns:repeat(3, 1fr); gap:18px; }
    .dest-adm-card { background:#fff; border-radius:14px; border:1px solid #e4e8f0; box-shadow:0 2px 12px rgba(13,31,53,.05); overflow:hidden; display:flex; flex-direction:column; }
    .dest-adm-img { width:100%; height:150px; object-fit:cover; background:#f0f2f7; display:block; }
    .dest-adm-body { padding:16px 18px 18px; flex:1; display:flex; flex-direction:column; }
    .dest-adm-name { font-size:16px; font-weight:700; color:#182b39; margin-bottom:3px; }
    .dest-adm-tag  { font-size:13px; color:#888; margin-bottom:10px; }
    .dest-adm-meta { display:flex; gap:6px; flex-wrap:wrap; margin-bottom:12px; }
    .dest-adm-chip { background:#f0f2f7; color:#555; padding:3px 9px; border-radius:50px; font-size:11px; }
    .dest-adm-chip.off { background:#fce4e4; color:#c62828; }
    .dest-adm-foot { display:flex; gap:8px; margin-top:auto; }
    .btn-edit-dest { flex:1; background:#0f5f86; color:#fff; border:none; border-radius:7px; padding:7px 12px; font-size:12px; font-weight:600; cursor:pointer; }
    .btn-edit-dest:hover { background:#0c4d6d; }
    .btn-del-dest  { background:#fff; color:#e74c3c; border:1px solid #e74c3c; border-radius:7px; padding:7px 12px; font-size:12px; font-weight:600; cursor:pointer; }
    .btn-del-dest:hover  { background:#e74c3c; color:#fff; }

    .no-dest { text-align:center; padding:80px 20px; color:#bbb; background:#fff; border-radius:14px; border:1px solid #e4e8f0; }
    .no-dest i { font-size:40px; display:block; margin-bottom:12px; }

    /* ── Shared Modal ── */
    .adm-modal-overlay { position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,.48); display:flex; align-items:center; justify-content:center; z-index:2000; padding:16px; }
    .adm-modal { background:#fff; border-radius:16px; padding:28px 32px; max-width:620px; width:100%; max-height:92vh; overflow-y:auto; }
    .adm-modal-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:22px; }
    .adm-modal-head h3 { font-size:18px; font-weight:700; color:#1a1a2e; margin:0; }
    .adm-modal-close { background:none; border:none; font-size:22px; cursor:pointer; color:#aaa; }
    .adm-form-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px; }
    .adm-form-row.single { grid-template-columns:1fr; }
    .adm-form-group { display:flex; flex-direction:column; }
    .adm-form-group label { font-size:13px; font-weight:600; color:#444; margin-bottom:6px; }
    .adm-form-group input,
    .adm-form-group select { padding:10px 14px; border:1.5px solid #e0e0e0; border-radius:8px; font-size:14px; outline:none; font-family:inherit; background:#fff; color:#1a1a2e; }
    .adm-form-group input:focus,
    .adm-form-group select:focus { border-color:#0D1F35; }
    .adm-form-help { font-size:12px; color:#8a94a2; margin-top:6px; }
    .adm-check-row { display:flex; align-items:center; gap:8px; font-size:14px; color:#444; margin-bottom:16px; }
    .adm-check-row input[type=checkbox] { width:16px; height:16px; accent-color:#0D1F35; cursor:pointer; }
    .nearby-box { border:1.5px solid #e0e0e0; border-radius:8px; padding:10px 12px; max-height:150px; overflow-y:auto; display:flex; flex-direction:column; gap:7px; }
    .nearby-box label { display:flex; align-items:center; gap:8px; font-size:13px; font-weight:500; color:#444; margin:0; cursor:pointer; }
    .nearby-box input[type=checkbox] { width:15px; height:15px; accent-color:#0D1F35; cursor:pointer; }
    .img-preview-strip { display:flex; gap:8px; flex-wrap:wrap; margin-top:8px; }
    .img-preview-strip img { width:96px; height:70px; object-fit:cover; border-radius:6px; border:1px solid #e0e0e0; }
    .adm-modal-foot { display:flex; justify-content:flex-end; border-top:1px solid #f0f0f0; padding-top:18px; margin-top:8px; }
    .btn-save { background:#0D1F35; color:#fff; border:none; padding:11px 28px; border-radius:8px; font-size:14px; font-weight:600; cursor:pointer; }
    .btn-save:hover { background:#1e3a5f; }

    @media (max-width: 991px) { .dest-grid { grid-template-columns:repeat(2, 1fr); } }
    @media (max-width: 767px) {
        .dest-grid { grid-template-columns:1fr; }
        .dest-toolbar { flex-direction:column; align-items:flex-start; }
        .dest-toolbar .admin-primary-btn { width:100%; justify-content:center; }
        .adm-form-row { grid-template-columns:1fr !important; }
        .adm-modal-overlay { padding:0; align-items:flex-end; }
        .adm-modal { border-radius:18px 18px 0 0; padding:22px 18px 28px; max-height:92vh; width:100%; max-width:100%; }
        .adm-modal-foot { justify-content:stretch; }
        .btn-save { width:100%; text-align:center; }
    }
</style>
@endsection

@section('content')
<div class="dest-page">

    @include('layouts.partials.admin_topbar', ['title' => 'Destinations', 'searchInputId' => 'destSearch', 'searchAriaLabel' => 'Search destinations'])

    @if(session('success'))
        <div class="adm-flash success"><i class="fas fa-check-circle" style="margin-right:6px"></i>{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="adm-flash error">
            @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
    @endif

    <div class="dest-hint">
        <i class="fas fa-info-circle" style="margin-right:6px;color:#0f5f86;"></i>
        These are the cards in the sliding strip on the hotel booking page. Clicking one filters the hotel list
        by that location, matching any hotel whose address contains the name. "Nearby" decides which
        destinations get suggested when this one has no hotels yet.
    </div>

    <div class="dest-toolbar">
        <span style="font-size:14px;color:#666;">{{ $destinations->count() }} destination{{ $destinations->count() !== 1 ? 's' : '' }}</span>
        <button class="admin-primary-btn" type="button" onclick="openAddModal()">
            <i class="fas fa-plus"></i> Add Destination
        </button>
    </div>

    @if($destinations->count())
    <div class="dest-grid" id="destGrid">
        @foreach($destinations as $destination)
        @php
            $nearbyNames = $destinations->whereIn('id', $destination->nearby ?? [])->pluck('name');
        @endphp
        <div class="dest-adm-card dest-item" data-searchable>
            <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}" class="dest-adm-img">
            <div class="dest-adm-body">
                <div class="dest-adm-name">{{ $destination->name }}</div>
                <div class="dest-adm-tag">
                    <i class="fas fa-map-marker-alt" style="color:#C85A2A;margin-right:4px;font-size:11px;"></i>{{ $destination->tag }}
                </div>
                <div class="dest-adm-meta">
                    @if($nearbyNames->count())
                        <span class="dest-adm-chip">Near: {{ $nearbyNames->join(', ') }}</span>
                    @else
                        <span class="dest-adm-chip">No nearby set</span>
                    @endif
                    @if(!$destination->active)
                        <span class="dest-adm-chip off">Hidden</span>
                    @endif
                </div>
                <div class="dest-adm-foot">
                    <button class="btn-edit-dest" onclick="openEditModal({{ $destination->id }})">Edit</button>
                    <button class="btn-del-dest"  onclick="deleteDestination({{ $destination->id }})">Delete</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="no-dest">
        <i class="fas fa-map-marked-alt"></i>
        No destinations yet. Click "Add Destination" to get started.
    </div>
    @endif
</div>

{{-- ── Add Modal ── --}}
<div class="adm-modal-overlay" id="addModal" style="display:none;">
    <div class="adm-modal">
        <div class="adm-modal-head">
            <h3>Add Destination</h3>
            <button class="adm-modal-close" onclick="document.getElementById('addModal').style.display='none'">&times;</button>
        </div>
        <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="adm-form-row">
                <div class="adm-form-group">
                    <label>Location Name <span style="color:#e74c3c">*</span></label>
                    <input type="text" name="name" placeholder="e.g. Musanze" required>
                    <span class="adm-form-help">Hotels are matched by this word appearing in their address.</span>
                </div>
                <div class="adm-form-group">
                    <label>Subtitle</label>
                    <input type="text" name="tag" placeholder="Rwanda">
                    <span class="adm-form-help">Shown when the location has no hotels yet.</span>
                </div>
            </div>
            <div class="adm-form-row single">
                <div class="adm-form-group">
                    <label>Photo</label>
                    <input type="file" name="image" accept="image/*" onchange="previewDestImg(this,'addImgPreview')">
                    <div class="img-preview-strip" id="addImgPreview"></div>
                </div>
            </div>
            <div class="adm-form-row">
                <div class="adm-form-group">
                    <label>Display Order</label>
                    <input type="number" name="sort_order" value="{{ $destinations->count() }}" min="0">
                </div>
                <div class="adm-form-group">
                    <label>Nearby Destinations</label>
                    <div class="nearby-box">
                        @forelse($destinations as $option)
                            <label>
                                <input type="checkbox" name="nearby[]" value="{{ $option->id }}">
                                {{ $option->name }}
                            </label>
                        @empty
                            <span style="font-size:12px;color:#999;">Add more destinations first.</span>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="adm-check-row">
                <input type="checkbox" name="active" id="addActive" checked>
                <label for="addActive">Show on the hotel booking page</label>
            </div>
            <div class="adm-modal-foot">
                <button type="submit" class="btn-save">Add Destination</button>
            </div>
        </form>
    </div>
</div>

{{-- ── Edit Modal ── --}}
<div class="adm-modal-overlay" id="editModal" style="display:none;">
    <div class="adm-modal">
        <div class="adm-modal-head">
            <h3>Edit Destination</h3>
            <button class="adm-modal-close" onclick="document.getElementById('editModal').style.display='none'">&times;</button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="adm-form-row">
                <div class="adm-form-group">
                    <label>Location Name <span style="color:#e74c3c">*</span></label>
                    <input type="text" name="name" id="editName" required>
                </div>
                <div class="adm-form-group">
                    <label>Subtitle</label>
                    <input type="text" name="tag" id="editTag">
                </div>
            </div>
            <div class="adm-form-row single">
                <div class="adm-form-group">
                    <label>Replace Photo <span style="font-weight:400;color:#999">(leave empty to keep the current one)</span></label>
                    <input type="file" name="image" accept="image/*" onchange="previewDestImg(this,'editImgPreview')">
                    <div class="img-preview-strip" id="editCurrentImg"></div>
                    <div class="img-preview-strip" id="editImgPreview"></div>
                </div>
            </div>
            <div class="adm-form-row">
                <div class="adm-form-group">
                    <label>Display Order</label>
                    <input type="number" name="sort_order" id="editSortOrder" min="0">
                </div>
                <div class="adm-form-group">
                    <label>Nearby Destinations</label>
                    <div class="nearby-box" id="editNearbyBox">
                        @foreach($destinations as $option)
                            <label data-dest-id="{{ $option->id }}">
                                <input type="checkbox" name="nearby[]" value="{{ $option->id }}">
                                {{ $option->name }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="adm-check-row">
                <input type="checkbox" name="active" id="editActive">
                <label for="editActive">Show on the hotel booking page</label>
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
function openAddModal() {
    document.getElementById('addModal').style.display = 'flex';
}

function openEditModal(id) {
    fetch('/admin/destinations/' + id + '/data')
        .then(function (r) { return r.json(); })
        .then(function (d) {
            document.getElementById('editForm').action = '/admin/destinations/' + id;
            document.getElementById('editName').value      = d.name || '';
            document.getElementById('editTag').value       = d.tag || '';
            document.getElementById('editSortOrder').value = d.sort_order || 0;
            document.getElementById('editActive').checked  = d.active;

            document.getElementById('editCurrentImg').innerHTML = d.image
                ? '<img src="' + d.image + '" alt="destination">'
                : '';
            document.getElementById('editImgPreview').innerHTML = '';

            // Tick the saved neighbours, and never offer the destination itself.
            var nearby = d.nearby || [];
            document.querySelectorAll('#editNearbyBox label').forEach(function (row) {
                var rowId = parseInt(row.getAttribute('data-dest-id'), 10);
                var box   = row.querySelector('input');
                row.style.display = rowId === d.id ? 'none' : '';
                box.checked = nearby.indexOf(rowId) !== -1;
            });

            document.getElementById('editModal').style.display = 'flex';
        });
}

function deleteDestination(id) {
    if (!confirm('Delete this destination? It will also be removed from other destinations\' nearby lists.')) return;
    var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '/admin/destinations/' + id;
    [['_token', csrf], ['_method', 'DELETE']].forEach(function (p) {
        var inp = document.createElement('input');
        inp.type = 'hidden'; inp.name = p[0]; inp.value = p[1];
        form.appendChild(inp);
    });
    document.body.appendChild(form);
    form.submit();
}

function previewDestImg(input, previewId) {
    var container = document.getElementById(previewId);
    container.innerHTML = '';
    if (!input.files || !input.files[0]) return;
    var reader = new FileReader();
    reader.onload = function (e) {
        var img = document.createElement('img');
        img.src = e.target.result;
        container.appendChild(img);
    };
    reader.readAsDataURL(input.files[0]);
}

document.addEventListener('DOMContentLoaded', function () {
    var destSearch = document.getElementById('destSearch');
    if (destSearch) {
        destSearch.addEventListener('input', function () {
            var q = destSearch.value.trim().toLowerCase();
            document.querySelectorAll('.dest-item').forEach(function (card) {
                card.style.display = card.textContent.toLowerCase().includes(q) ? '' : 'none';
            });
        });
    }
});
</script>
@endsection

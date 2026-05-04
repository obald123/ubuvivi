@extends('layouts.app')

@section('title')
    Bookings
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

    .req-tabs { display:flex; align-items:center; gap:6px; margin-bottom:20px; }
    .req-tab { display:inline-flex; align-items:center; gap:8px; padding:9px 20px; border-radius:50px; border:none; background:transparent; font-size:14px; font-weight:500; color:#555; cursor:pointer; transition:background .2s,color .2s; }
    .req-tab .rc { display:inline-flex; align-items:center; justify-content:center; width:22px; height:22px; border-radius:50%; background:#1a1a2e; color:#fff; font-size:11px; font-weight:700; }
    .req-tab.active { background:linear-gradient(135deg, #38BDF8, #2563EB); color:#fff; }
    .req-tab.active .rc { background:rgba(255,255,255,.25); color:#fff; }
    .req-tab:hover:not(.active) { background:#f0f0f0; color:#333; }

    .req-panel { background:#fff; border-radius:16px; box-shadow:0 1px 8px rgba(0,0,0,.06); padding:24px 28px; }
    .req-table { width:100%; border-collapse:collapse; }
    .req-table th { text-align:left; font-size:13px; font-weight:500; color:#888; padding:10px 14px; border-bottom:1px solid #f0f0f0; }
    .req-table td { padding:14px 14px; font-size:14px; color:#1a1a2e; border-bottom:1px solid #f7f7f7; vertical-align:middle; }
    .req-table tr:last-child td { border-bottom:none; }
    .req-table tr:hover td { background:#fafafa; }

    .sb { display:inline-block; padding:4px 14px; border-radius:20px; font-size:12px; font-weight:500; }
    .sb-completed { background:#E8F8F0; color:#27AE60; }
    .sb-active    { background:#FFF8E6; color:#F0A500; }
    .sb-upcoming  { background:#EEF2FF; color:#4F6CDE; }
    .sb-pending   { background:#F5F5F5; color:#888; }

    .vd-link { color:#4F9DE8; font-size:13px; font-weight:500; text-decoration:none; background:none; border:none; cursor:pointer; padding:0; }
    .vd-link:hover { text-decoration:underline; color:#2563EB; }

    .req-pagination { display:flex; align-items:center; justify-content:center; gap:6px; margin-top:20px; }
    .pg-btn { width:34px; height:34px; border-radius:8px; display:inline-flex; align-items:center; justify-content:center; font-size:13px; font-weight:600; cursor:pointer; border:1px solid #e8e8e8; background:#fff; color:#555; transition:background .2s,color .2s; text-decoration:none; }
    .pg-btn:hover { background:#f5f5f5; }
    .pg-btn.active { background:#2563EB; color:#fff; border-color:#2563EB; }

    .adm-modal-overlay { position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,.45); display:flex; align-items:center; justify-content:center; z-index:2000; }
    .adm-modal { background:#fff; border-radius:16px; padding:28px; max-width:560px; width:90%; max-height:90vh; overflow-y:auto; }
    .adm-modal-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
    .adm-modal-head h3 { font-size:18px; font-weight:700; color:#1a1a2e; margin:0; }
    .adm-modal-close { background:none; border:none; font-size:22px; cursor:pointer; color:#aaa; line-height:1; }
    .adm-modal-close:hover { color:#555; }
    .detail-sec { background:#f8f9fa; border-radius:10px; padding:16px; margin-bottom:14px; }
    .detail-sec h4 { font-size:14px; font-weight:700; color:#1a1a2e; margin:0 0 10px 0; }
    .detail-row { display:flex; gap:10px; margin-bottom:7px; font-size:13px; }
    .detail-row:last-child { margin-bottom:0; }
    .detail-lbl { font-weight:600; color:#888; min-width:110px; }
    .detail-val { color:#333; }
    .adm-modal-foot { display:flex; gap:8px; justify-content:flex-end; margin-top:20px; }
    .btn-complete { background:#27AE60; color:#fff; border:none; padding:10px 20px; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer; }
    .btn-complete:hover { background:#219a54; }
    .btn-cancel-bk  { background:#E53935; color:#fff; border:none; padding:10px 20px; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer; }
    .btn-cancel-bk:hover { background:#c62828; }
    .btn-close-modal { background:#f0f0f0; color:#555; border:none; padding:10px 20px; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer; }
    .btn-close-modal:hover { background:#e0e0e0; }
    .no-data { text-align:center; color:#bbb; padding:36px 0; font-size:14px; }
</style>
@endsection

@section('content')

    <div class="adm-topbar">
        <h1>Bookings</h1>
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
        </div>
    </div>

    <div class="req-tabs">
        <button class="req-tab active" data-filter="all">All <span class="rc">{{ $allCount }}</span></button>
        <button class="req-tab" data-filter="active">Active <span class="rc">{{ $activeCount }}</span></button>
        <button class="req-tab" data-filter="upcoming">Upcoming <span class="rc">{{ $upcomingCount }}</span></button>
        <button class="req-tab" data-filter="completed">Completed <span class="rc">{{ $completedCount }}</span></button>
    </div>

    <div class="req-panel">
        @if($allBookings->count())
        <table class="req-table" id="bkTable">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($allBookings as $bk)
                <tr data-status="{{ strtolower($bk['status']) }}">
                    <td>{{ $bk['type'] }}</td>
                    <td>{{ $bk['service'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($bk['date'])->format('d F Y') }}</td>
                    <td>{{ $bk['client'] }}</td>
                    <td>
                        @php $st = strtolower($bk['status']); @endphp
                        <span class="sb sb-{{ $st }}">{{ $bk['status'] }}</span>
                    </td>
                    <td>
                        <button class="vd-link btn-view"
                                data-mtype="{{ $bk['model_type'] }}"
                                data-mid="{{ $bk['model_id'] }}">
                            View Details
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="req-pagination" id="bkPagination"></div>
        @else
        <div class="no-data"><i class="fas fa-calendar-alt" style="font-size:28px;display:block;margin-bottom:10px;color:#ddd;"></i>No bookings found.</div>
        @endif
    </div>

    <div class="adm-modal-overlay" id="bkModal" style="display:none;">
        <div class="adm-modal">
            <div class="adm-modal-head">
                <h3>Booking Details</h3>
                <button class="adm-modal-close" onclick="closeBkModal()">&times;</button>
            </div>
            <div id="bkModalBody"></div>
            <div class="adm-modal-foot">
                <button class="btn-close-modal" onclick="closeBkModal()">Close</button>
                <button class="btn-complete" id="btnComplete">Mark Completed</button>
                <button class="btn-cancel-bk"  id="btnCancel">Cancel</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
var rowsPerPage = 9, currentPage = 1, currentFilter = 'all';

function allRows() { return Array.from(document.querySelectorAll('#bkTable tbody tr')); }
function visibleRows() {
    var search = (document.getElementById('searchInput') || {}).value || '';
    search = search.toLowerCase();
    return allRows().filter(function(r) {
        if (currentFilter !== 'all' && r.dataset.status !== currentFilter) return false;
        if (search && !r.textContent.toLowerCase().includes(search)) return false;
        return true;
    });
}
function renderPage() {
    var rows = visibleRows();
    var pages = Math.max(1, Math.ceil(rows.length / rowsPerPage));
    if (currentPage > pages) currentPage = 1;
    allRows().forEach(function(r) { r.style.display = 'none'; });
    rows.slice((currentPage-1)*rowsPerPage, currentPage*rowsPerPage).forEach(function(r){ r.style.display=''; });
    var pg = document.getElementById('bkPagination');
    if (!pg) return;
    var html = '';
    for (var i = 1; i <= pages; i++) html += '<a class="pg-btn'+(i===currentPage?' active':'')+'" onclick="goPage('+i+')">'+i+'</a>';
    if (currentPage < pages) html += '<a class="pg-btn" onclick="goPage('+(currentPage+1)+')">&#8250;</a>';
    pg.innerHTML = html;
}
function goPage(p) { currentPage = p; renderPage(); }

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.req-tab').forEach(function(tab) {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.req-tab').forEach(function(t){ t.classList.remove('active'); });
            tab.classList.add('active');
            currentFilter = tab.dataset.filter; currentPage = 1; renderPage();
        });
    });
    var si = document.getElementById('searchInput');
    if (si) si.addEventListener('input', function(){ currentPage=1; renderPage(); });

    document.querySelectorAll('.btn-view').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var mtype = btn.dataset.mtype, mid = btn.dataset.mid;
            fetch('/bookings/' + mtype + '/' + mid)
                .then(function(r){ return r.json(); })
                .then(function(data){ openBkModal(data, mtype, mid); })
                .catch(function(){ alert('Error loading booking details'); });
        });
    });

    document.getElementById('btnComplete').addEventListener('click', function() { postBkStatus('Completed'); });
    document.getElementById('btnCancel').addEventListener('click', function() { postBkStatus('Cancelled'); });

    renderPage();
});

var _mtype = '', _mid = '';
function openBkModal(data, mtype, mid) {
    _mtype = mtype; _mid = mid;
    var stype = mtype === 'TourBooking' ? 'Tour & Travel' : mtype === 'CarBooking' ? 'Car Rental' : 'Transfers';
    var sname = '';
    if (mtype === 'TourBooking' && data.tour) sname = data.tour.title || 'N/A';
    else if (data.vehicle) sname = (data.vehicle.brand ? data.vehicle.brand.name : '') + ' ' + (data.vehicle.model ? data.vehicle.model.name : '');
    var date = data.date || data.pickup_date || 'N/A';
    var status = data.completed ? 'Completed' : data.cancelled ? 'Cancelled' : data.approved ? 'Active' : 'Pending';
    var scMap = {Completed:'sb-completed', Cancelled:'sb-rejected', Active:'sb-active', Pending:'sb-pending'};

    document.getElementById('bkModalBody').innerHTML =
        '<div class="detail-sec"><h4>Client</h4>' +
            '<div class="detail-row"><span class="detail-lbl">Name</span><span class="detail-val">'+(data.names||'N/A')+'</span></div>' +
            '<div class="detail-row"><span class="detail-lbl">Email</span><span class="detail-val">'+(data.email||'N/A')+'</span></div>' +
            '<div class="detail-row"><span class="detail-lbl">Phone</span><span class="detail-val">'+(data.phone_number||'N/A')+'</span></div>' +
        '</div>' +
        '<div class="detail-sec"><h4>Service</h4>' +
            '<div class="detail-row"><span class="detail-lbl">Service</span><span class="detail-val">'+stype+'</span></div>' +
            '<div class="detail-row"><span class="detail-lbl">Type</span><span class="detail-val">'+sname+'</span></div>' +
            '<div class="detail-row"><span class="detail-lbl">Date</span><span class="detail-val">'+date+'</span></div>' +
            '<div class="detail-row"><span class="detail-lbl">Details</span><span class="detail-val">'+(data.message||'N/A')+'</span></div>' +
        '</div>' +
        '<div class="detail-sec"><h4>Status</h4>' +
            '<div class="detail-row"><span class="detail-lbl">Current</span><span class="detail-val"><span class="sb '+(scMap[status]||'sb-pending')+'">'+status+'</span></span></div>' +
        '</div>';
    document.getElementById('bkModal').style.display = 'flex';
}
function closeBkModal() { document.getElementById('bkModal').style.display = 'none'; }
function postBkStatus(status) {
    fetch('/bookings/' + _mtype + '/' + _mid + '/status', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
        body: 'status=' + status
    }).then(function(){ location.reload(); }).catch(function(){ alert('Error updating status'); });
}
</script>
@endsection

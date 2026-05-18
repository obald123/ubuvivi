@extends('layouts.app')
@section('title') Hotel Bookings @endsection

@section('css')
<style>
    .hb-page { display:flex; flex-direction:column; gap:22px; width:100%; }
    .adm-flash { padding:12px 18px; border-radius:10px; font-size:14px; margin-bottom:4px; }
    .adm-flash.success { background:#f0fdf4; border:1px solid #bbf7d0; color:#15803d; }

    .hb-toolbar { display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
    .hb-count-badge { padding:5px 14px; border-radius:50px; font-size:12px; font-weight:600; }
    .hb-count-badge.all      { background:#e8efff; color:#4a73e8; }
    .hb-count-badge.pending  { background:#fff3e0; color:#e67e22; }
    .hb-count-badge.approved { background:#e8f5e9; color:#2e7d32; }
    .hb-count-badge.rejected { background:#fce4e4; color:#c62828; }

    .hb-table-wrap { background:#fff; border-radius:16px; box-shadow:0 2px 16px rgba(13,31,53,.06); overflow:hidden; }
    .hb-table { width:100%; border-collapse:collapse; }
    .hb-table thead tr { background:#f8f9fb; }
    .hb-table th { padding:13px 16px; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.6px; border-bottom:1px solid #e8ecf2; white-space:nowrap; }
    .hb-table td { padding:13px 16px; font-size:14px; color:#374151; border-bottom:1px solid #f0f2f7; vertical-align:middle; }
    .hb-table tr:last-child td { border-bottom:none; }
    .hb-table tr:hover td { background:#fafbfc; }

    .status-badge { display:inline-flex; align-items:center; gap:5px; font-size:12px; font-weight:600; padding:3px 10px; border-radius:50px; }
    .status-badge.pending  { background:#fff3e0; color:#e67e22; }
    .status-badge.approved { background:#e8f5e9; color:#2e7d32; }
    .status-badge.rejected { background:#fce4e4; color:#c62828; }

    .tbl-actions { display:flex; gap:8px; flex-wrap:wrap; }
    .btn-approve { background:#2e7d32; color:#fff; border:none; border-radius:7px; padding:5px 12px; font-size:12px; font-weight:600; cursor:pointer; }
    .btn-approve:hover { background:#1b5e20; }
    .btn-reject  { background:#c62828; color:#fff; border:none; border-radius:7px; padding:5px 12px; font-size:12px; font-weight:600; cursor:pointer; }
    .btn-reject:hover  { background:#b71c1c; }
    .btn-view    { background:#0f5f86; color:#fff; border:none; border-radius:7px; padding:5px 12px; font-size:12px; font-weight:600; cursor:pointer; }
    .btn-view:hover    { background:#0c4d6d; }

    .adm-modal-overlay { position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,.48); display:flex; align-items:center; justify-content:center; z-index:2000; padding:16px; }
    .adm-modal { background:#fff; border-radius:16px; padding:28px 32px; max-width:580px; width:100%; max-height:90vh; overflow-y:auto; }
    .adm-modal-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
    .adm-modal-head h3 { font-size:18px; font-weight:700; color:#1a1a2e; margin:0; }
    .adm-modal-close { background:none; border:none; font-size:22px; cursor:pointer; color:#aaa; }
    .detail-row { display:flex; gap:6px; margin-bottom:10px; font-size:14px; }
    .detail-label { font-weight:600; color:#444; min-width:150px; }
    .detail-val   { color:#374151; }
    .detail-divider { border:none; border-top:1px solid #f0f2f7; margin:14px 0; }

    .no-data { text-align:center; padding:60px 20px; color:#bbb; }
    .no-data i { font-size:36px; display:block; margin-bottom:12px; }

    @media (max-width: 991px) { .hb-table-wrap { overflow-x:auto; } .hb-table { min-width:780px; } }
    @media (max-width: 767px) {
        .hb-toolbar { flex-direction:column; align-items:flex-start; }
        .adm-modal-overlay { padding:0; align-items:flex-end; }
        .adm-modal { border-radius:18px 18px 0 0; max-height:92vh; width:100%; max-width:100%; padding:22px 18px 28px; }
    }
</style>
@endsection

@section('content')
<div class="hb-page">

    @include('layouts.partials.admin_topbar', ['title' => 'Hotel Bookings', 'searchInputId' => 'hbSearch', 'searchAriaLabel' => 'Search bookings'])

    @if(session('success'))
        <div class="adm-flash success"><i class="fas fa-check-circle" style="margin-right:6px"></i>{{ session('success') }}</div>
    @endif

    <div class="hb-toolbar">
        <span class="hb-count-badge all">All: {{ $bookings->count() }}</span>
        <span class="hb-count-badge pending">Pending: {{ $bookings->whereNull('approved')->count() }}</span>
        <span class="hb-count-badge approved">Approved: {{ $bookings->where('approved', true)->count() }}</span>
        <span class="hb-count-badge rejected">Rejected: {{ $bookings->where('approved', false)->count() }}</span>
    </div>

    <div class="hb-table-wrap">
        @if($bookings->count())
        <table class="hb-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Hotel</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Guests</th>
                    <th>Room Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="hbTableBody">
                @foreach($bookings as $b)
                <tr class="hb-row">
                    <td style="color:#aaa;font-size:12px;">{{ $b->id }}</td>
                    <td>
                        <div style="font-weight:600;color:#182b39;">{{ $b->names }}</div>
                        <div style="font-size:12px;color:#888;">{{ $b->email }}</div>
                    </td>
                    <td style="font-size:13px;">{{ optional($b->hotel)->name ?? '—' }}</td>
                    <td style="font-size:13px;white-space:nowrap;">{{ $b->check_in?->format('d M Y') }}</td>
                    <td style="font-size:13px;white-space:nowrap;">{{ $b->check_out?->format('d M Y') }}</td>
                    <td style="text-align:center;">{{ $b->number_of_guests }}</td>
                    <td style="font-size:13px;">{{ $b->room_type ?: '—' }}</td>
                    <td>
                        <span class="status-badge {{ strtolower($b->status_label) }}">{{ $b->status_label }}</span>
                    </td>
                    <td>
                        <div class="tbl-actions">
                            <button class="btn-view" onclick="viewBooking({{ $b->id }})">View</button>
                            @if($b->approved !== true)
                                <button class="btn-approve" onclick="updateStatus({{ $b->id }},'Approved',this)">Approve</button>
                            @endif
                            @if($b->approved !== false)
                                <button class="btn-reject"  onclick="updateStatus({{ $b->id }},'Rejected',this)">Reject</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="no-data">
            <i class="fas fa-hotel"></i>
            No hotel booking requests yet.
        </div>
        @endif
    </div>
</div>

<div class="adm-modal-overlay" id="detailModal" style="display:none;">
    <div class="adm-modal">
        <div class="adm-modal-head">
            <h3>Hotel Booking Details</h3>
            <button class="adm-modal-close" onclick="document.getElementById('detailModal').style.display='none'">&times;</button>
        </div>
        <div id="detailContent"></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
var allBookings = @json($bookings->map(fn($b) => [
    'id' => $b->id,
    'names' => $b->names,
    'email' => $b->email,
    'phone_number' => $b->phone_number,
    'hotel_name' => optional($b->hotel)->name,
    'check_in' => $b->check_in?->format('d M Y'),
    'check_out' => $b->check_out?->format('d M Y'),
    'number_of_guests' => $b->number_of_guests,
    'room_type' => $b->room_type,
    'message' => $b->message,
    'status_label' => $b->status_label,
]));

var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function viewBooking(id) {
    var b = allBookings.find(function(x){ return x.id === id; });
    if (!b) return;
    document.getElementById('detailContent').innerHTML =
        row('Client', b.names) + row('Email', b.email) + row('Phone', b.phone_number) +
        '<hr class="detail-divider">' +
        row('Hotel', b.hotel_name || 'Unknown') +
        row('Check-in',  b.check_in  || '—') +
        row('Check-out', b.check_out || '—') +
        row('Guests', b.number_of_guests) +
        row('Room Type', b.room_type || '—') +
        '<hr class="detail-divider">' +
        row('Status', b.status_label) +
        row('Message', b.message || 'None');
    document.getElementById('detailModal').style.display = 'flex';
}

function row(label, val) {
    return '<div class="detail-row"><span class="detail-label">' + label + ':</span><span class="detail-val">' + (val || '—') + '</span></div>';
}

function updateStatus(id, status, btn) {
    if (!confirm('Mark this booking as ' + status + '?')) return;
    fetch('/admin/hotel-bookings/' + id + '/status', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
        body: JSON.stringify({ status: status })
    })
    .then(function(r){ return r.json(); })
    .then(function(d){ if (d.success) location.reload(); });
}

document.addEventListener('DOMContentLoaded', function() {
    var si = document.getElementById('hbSearch');
    if (si) si.addEventListener('input', function() {
        var val = si.value.toLowerCase();
        document.querySelectorAll('.hb-row').forEach(function(r) {
            r.style.display = r.textContent.toLowerCase().includes(val) ? '' : 'none';
        });
    });
});
</script>
@endsection

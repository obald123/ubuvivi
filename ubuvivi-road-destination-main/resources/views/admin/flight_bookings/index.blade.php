@extends('layouts.app')
@section('title') Flight Bookings @endsection

@section('css')
<style>
    .fb-page { display:flex; flex-direction:column; gap:22px; width:100%; }
    .adm-flash { padding:12px 18px; border-radius:10px; font-size:14px; margin-bottom:4px; }
    .adm-flash.success { background:#f0fdf4; border:1px solid #bbf7d0; color:#15803d; }
    .adm-flash.error   { background:#fef2f2; border:1px solid #fecaca; color:#dc2626; }

    .fb-toolbar { display:flex; align-items:center; justify-content:space-between; gap:14px; flex-wrap:wrap; }
    .fb-counts { display:flex; gap:10px; flex-wrap:wrap; }
    .fb-count-badge { padding:5px 14px; border-radius:50px; font-size:12px; font-weight:600; }
    .fb-count-badge.all      { background:#e8efff; color:#4a73e8; }
    .fb-count-badge.pending  { background:#fff3e0; color:#e67e22; }
    .fb-count-badge.approved { background:#e8f5e9; color:#2e7d32; }
    .fb-count-badge.rejected { background:#fce4e4; color:#c62828; }

    .fb-table-wrap { background:#fff; border-radius:16px; box-shadow:0 2px 16px rgba(13,31,53,.06); overflow:hidden; }
    .fb-table { width:100%; border-collapse:collapse; }
    .fb-table thead tr { background:#f8f9fb; }
    .fb-table th { padding:13px 16px; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.6px; border-bottom:1px solid #e8ecf2; white-space:nowrap; }
    .fb-table td { padding:13px 16px; font-size:14px; color:#374151; border-bottom:1px solid #f0f2f7; vertical-align:middle; }
    .fb-table tr:last-child td { border-bottom:none; }
    .fb-table tr:hover td { background:#fafbfc; }

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

    /* Detail modal */
    .adm-modal-overlay { position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,.48); display:flex; align-items:center; justify-content:center; z-index:2000; padding:16px; }
    .adm-modal { background:#fff; border-radius:16px; padding:28px 32px; max-width:620px; width:100%; max-height:90vh; overflow-y:auto; }
    .adm-modal-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
    .adm-modal-head h3 { font-size:18px; font-weight:700; color:#1a1a2e; margin:0; }
    .adm-modal-close { background:none; border:none; font-size:22px; cursor:pointer; color:#aaa; }
    .detail-row { display:flex; gap:6px; margin-bottom:10px; font-size:14px; }
    .detail-label { font-weight:600; color:#444; min-width:160px; }
    .detail-val   { color:#374151; }
    .detail-divider { border:none; border-top:1px solid #f0f2f7; margin:14px 0; }
    .passport-grid { display:flex; gap:10px; flex-wrap:wrap; margin-top:6px; }
    .passport-grid img { width:80px; height:100px; object-fit:cover; border-radius:6px; border:1px solid #e0e0e0; }

    .no-data { text-align:center; padding:60px 20px; color:#bbb; }
    .no-data i { font-size:36px; display:block; margin-bottom:12px; }

    @media (max-width: 991px) { .fb-table-wrap { overflow-x:auto; } .fb-table { min-width:800px; } }
    @media (max-width: 767px) {
        .fb-toolbar { flex-direction:column; align-items:flex-start; }
        .adm-modal-overlay { padding:0; align-items:flex-end; }
        .adm-modal { border-radius:18px 18px 0 0; max-height:92vh; width:100%; max-width:100%; padding:22px 18px 28px; }
    }
</style>
@endsection

@section('content')
<div class="fb-page">

    @include('layouts.partials.admin_topbar', ['title' => 'Flight Bookings', 'searchInputId' => 'fbSearch', 'searchAriaLabel' => 'Search bookings'])

    @if(session('success'))
        <div class="adm-flash success"><i class="fas fa-check-circle" style="margin-right:6px"></i>{{ session('success') }}</div>
    @endif

    <div class="fb-toolbar">
        <div class="fb-counts">
            <span class="fb-count-badge all">All: {{ $bookings->count() }}</span>
            <span class="fb-count-badge pending">Pending: {{ $bookings->whereNull('approved')->count() }}</span>
            <span class="fb-count-badge approved">Approved: {{ $bookings->where('approved', true)->count() }}</span>
            <span class="fb-count-badge rejected">Rejected: {{ $bookings->where('approved', false)->count() }}</span>
        </div>
    </div>

    <div class="fb-table-wrap">
        @if($bookings->count())
        <table class="fb-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Route</th>
                    <th>Class</th>
                    <th>Passengers</th>
                    <th>Departure</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="fbTableBody">
                @for($sk=0;$sk<5;$sk++)
                <tr class="skel-row">
                    <td><span class="skel short"></span></td>
                    <td><span class="skel" style="width:70%;margin-bottom:6px;"></span><span class="skel short"></span></td>
                    <td><span class="skel short" style="margin-bottom:5px;"></span><span class="skel short"></span></td>
                    <td><span class="skel short"></span></td>
                    <td><span class="skel" style="width:30px;"></span></td>
                    <td><span class="skel short"></span></td>
                    <td><span class="skel" style="width:70px;height:22px;border-radius:50px;"></span></td>
                    <td><span class="skel" style="width:90px;height:28px;border-radius:7px;"></span></td>
                </tr>
                @endfor
                @foreach($bookings as $b)
                <tr class="fb-row" data-searchable>
                    <td style="color:#aaa;font-size:12px;">{{ $b->id }}</td>
                    <td>
                        <div style="font-weight:600;color:#182b39;">{{ $b->names }}</div>
                        <div style="font-size:12px;color:#888;">{{ $b->email }}</div>
                    </td>
                    <td>
                        <div style="font-size:13px;font-weight:600;">{{ $b->departure_airport }}</div>
                        <div style="font-size:12px;color:#888;"><i class="fas fa-arrow-right" style="font-size:10px;margin:0 3px;"></i>{{ $b->arrival_airport }}</div>
                    </td>
                    <td><span style="font-size:13px;">{{ $b->flight_class_label }}</span></td>
                    <td style="text-align:center;">{{ $b->number_of_passengers }}</td>
                    <td style="font-size:13px;white-space:nowrap;">{{ $b->departure_date?->format('d M Y') }}</td>
                    <td>
                        <span class="status-badge {{ strtolower($b->status_label) }}">
                            {{ $b->status_label }}
                        </span>
                    </td>
                    <td>
                        <div class="tbl-actions">
                            <button class="btn-view" onclick="viewBooking({{ $b->id }})">View</button>
                            @if($b->approved !== true)
                                <button class="btn-approve" onclick="updateStatus({{ $b->id }}, 'Approved', this)">Approve</button>
                            @endif
                            @if($b->approved !== false)
                                <button class="btn-reject" onclick="updateStatus({{ $b->id }}, 'Rejected', this)">Reject</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="no-data">
            <i class="fas fa-plane"></i>
            No flight booking requests yet.
        </div>
        @endif
    </div>
</div>

{{-- Detail Modal --}}
<div class="adm-modal-overlay" id="detailModal" style="display:none;">
    <div class="adm-modal">
        <div class="adm-modal-head">
            <h3>Flight Booking Details</h3>
            <button class="adm-modal-close" onclick="document.getElementById('detailModal').style.display='none'">&times;</button>
        </div>
        <div id="detailContent"></div>
    </div>
</div>
@endsection

@php
$bookingsJson = $bookings->map(function($b) {
    return [
        'id'                   => $b->id,
        'names'                => $b->names,
        'email'                => $b->email,
        'phone_number'         => $b->phone_number,
        'airline'              => $b->airline,
        'departure_airport'    => $b->departure_airport,
        'arrival_airport'      => $b->arrival_airport,
        'trip_type'            => $b->trip_type,
        'flight_class_label'   => $b->flight_class_label,
        'number_of_passengers' => $b->number_of_passengers,
        'departure_date'       => $b->departure_date ? $b->departure_date->format('d M Y') : null,
        'return_date'          => $b->return_date    ? $b->return_date->format('d M Y')    : null,
        'additional_info'      => $b->additional_info,
        'passport_photos'      => $b->passport_photos ?? [],
        'status_label'         => $b->status_label,
    ];
});
@endphp

@section('scripts')
<script>
var allBookings = @json($bookingsJson);

var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function viewBooking(id) {
    var b = allBookings.find(function(x){ return x.id === id; });
    if (!b) return;
    var passHtml = '';
    if (b.passport_photos && b.passport_photos.length) {
        passHtml = '<div class="detail-row"><span class="detail-label">Passport Photos:</span></div>';
        passHtml += '<div class="passport-grid">';
        b.passport_photos.forEach(function(url) {
            passHtml += '<img src="' + url + '" alt="passport">';
        });
        passHtml += '</div>';
    }
    document.getElementById('detailContent').innerHTML =
        row('Client', b.names) + row('Email', b.email) + row('Phone', b.phone_number) +
        '<hr class="detail-divider">' +
        row('Airline', b.airline || 'Not specified') +
        row('Route', b.departure_airport + ' → ' + b.arrival_airport) +
        row('Trip Type', b.trip_type === 'round' ? 'Round Trip' : 'One Way') +
        row('Class', b.flight_class_label) +
        row('Passengers', b.number_of_passengers) +
        row('Departure', b.departure_date || '—') +
        row('Return', b.return_date || '—') +
        '<hr class="detail-divider">' +
        row('Status', b.status_label) +
        row('Additional Info', b.additional_info || 'None') +
        passHtml;
    document.getElementById('detailModal').style.display = 'flex';
}

function row(label, val) {
    return '<div class="detail-row"><span class="detail-label">' + label + ':</span><span class="detail-val">' + (val || '—') + '</span></div>';
}

function updateStatus(id, status, btn) {
    if (!confirm('Mark this booking as ' + status + '?')) return;
    fetch('/admin/flight-bookings/' + id + '/status', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
        body: JSON.stringify({ status: status })
    })
    .then(function(r){ return r.json(); })
    .then(function(data) {
        if (data.success) location.reload();
    });
}

</script>
@endsection

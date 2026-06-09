@extends('layouts.client')

@section('title')
    My Bookings
@endsection

@section('css')
<style>
    .cd-topbar { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; gap:14px; flex-wrap:wrap; }
    .cd-search { display:flex; align-items:center; gap:10px; background:#fff; border:1px solid #e4e4e8; border-radius:10px; padding:10px 18px; flex:1; max-width:480px; }
    .cd-search i { color:#bbb; font-size:14px; }
    .cd-search input { border:none; outline:none; background:transparent; font-size:14px; color:#333; width:100%; }
    .cd-search input::placeholder { color:#bbb; }
    .cd-new-btn { background:#0D1F35; color:#fff; border:none; border-radius:50px; padding:10px 22px; font-size:14px; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:7px; white-space:nowrap; text-decoration:none; transition:background .2s; }
    .cd-new-btn:hover { background:#1e3a5f; color:#fff; text-decoration:none; }

    /* Stats bar */
    .cd-stats-bar { background:#fff; border-radius:16px; box-shadow:0 1px 8px rgba(0,0,0,.06); display:flex; align-items:stretch; margin-bottom:24px; overflow:hidden; }
    .cd-stat { flex:1; display:flex; align-items:center; justify-content:space-between; padding:20px 24px; border-right:1px solid #f0f0f0; }
    .cd-stat:last-child { border-right:none; }
    .cd-stat-label { font-size:12px; color:#888; font-weight:500; margin-bottom:6px; }
    .cd-stat-value { font-size:28px; font-weight:800; color:#1a1a2e; line-height:1; }
    .cd-stat-icon { width:46px; height:46px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:19px; flex-shrink:0; }
    .si-blue   { background:#EEF2FF; color:#4F6CDE; }
    .si-blue2  { background:#E8EFFE; color:#6B82F5; }
    .si-green  { background:#E8F8F0; color:#27AE60; }
    .si-yellow { background:#FFF8E6; color:#F0A500; }

    /* Filter tabs */
    .filter-tabs { display:flex; align-items:center; gap:6px; margin-bottom:18px; flex-wrap:wrap; }
    .ftab { display:inline-flex; align-items:center; gap:6px; padding:7px 16px; border-radius:50px; font-size:13px; font-weight:500; cursor:pointer; border:none; background:none; color:#555; transition:background .2s,color .2s; }
    .ftab .badge { background:#1a1a2e; color:#fff; border-radius:50%; width:20px; height:20px; display:inline-flex; align-items:center; justify-content:center; font-size:11px; font-weight:700; }
    .ftab.active { background:#2563EB; color:#fff; }
    .ftab.active .badge { background:rgba(255,255,255,.25); color:#fff; }

    /* Table panel */
    .cd-panel { background:#fff; border-radius:16px; box-shadow:0 1px 8px rgba(0,0,0,.06); padding:24px 28px; }
    .cd-table { width:100%; border-collapse:collapse; }
    .cd-table th { text-align:left; font-size:13px; font-weight:600; color:#888; padding:10px 14px; border-bottom:1px solid #f0f0f0; }
    .cd-table td { padding:14px 14px; font-size:14px; color:#1a1a2e; border-bottom:1px solid #f7f7f7; vertical-align:middle; }
    .cd-table tr:last-child td { border-bottom:none; }
    .cd-table tr.hidden-row { display:none; }
    .cd-table tr:hover td { background:#fafafa; }
    .cd-badge { display:inline-block; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:500; }
    .badge-confirmed { background:#E8F8F0; color:#27AE60; }
    .badge-pending   { background:#FFF8E6; color:#F0A500; }
    .badge-completed { background:#f0f0f0; color:#888; }
    .badge-rejected  { background:#FDECEA; color:#E53935; }
    .cd-link { color:#4F9DE8; font-size:13px; font-weight:500; text-decoration:none; }
    .cd-link:hover { text-decoration:underline; }
    .no-data { text-align:center; color:#bbb; padding:32px 0; font-size:14px; }

    /* Pagination */
    .cd-pagination { display:flex; align-items:center; justify-content:center; gap:6px; margin-top:24px; }
    .pg-btn { width:34px; height:34px; border-radius:8px; display:inline-flex; align-items:center; justify-content:center; font-size:13px; font-weight:600; cursor:pointer; border:1px solid #e8e8e8; background:#fff; color:#555; transition:background .2s,color .2s; text-decoration:none; }
    .pg-btn:hover { background:#f5f5f5; }
    .pg-btn.active { background:#2563EB; color:#fff; border-color:#2563EB; }
    .pg-arrow { background:none; border:1px solid #e8e8e8; }

    @media(max-width:900px) {
        .cd-stats-bar { flex-wrap: wrap; }
        .cd-stat { flex: 1 1 48%; border-right: none; border-bottom: 1px solid #f0f0f0; }
        .cd-stat:last-child { border-bottom: none; }
    }
    @media(max-width:576px) {
        .cd-stats-bar { flex-direction: column; }
        .cd-stat { flex: unset; width: 100%; }
        .cd-topbar { flex-direction: column; align-items: stretch; }
        .cd-search { max-width: 100%; }
    }
</style>
@endsection

@section('content')

    {{-- Topbar --}}
    <div class="cd-topbar">
        <div class="cd-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search bookings..." id="searchInput" autocomplete="off"
                   data-en="Search bookings..." data-fr="Rechercher...">
        </div>
        <a href="{{ route('guest.all_services') }}" class="cd-new-btn">
            <i class="fas fa-plus"></i> <span data-en="New Booking" data-fr="Nouvelle réservation">New Booking</span>
        </a>
    </div>

    {{-- Stats bar --}}
    <div class="cd-stats-bar">
        <div class="cd-stat">
            <div><div class="cd-stat-label" data-en="Upcoming Bookings" data-fr="À venir">Upcoming Bookings</div><div class="cd-stat-value">{{ $upcoming->count() }}</div></div>
            <div class="cd-stat-icon si-blue"><i class="fas fa-calendar-alt"></i></div>
        </div>
        <div class="cd-stat">
            <div><div class="cd-stat-label" data-en="Active Bookings" data-fr="Actives">Active Bookings</div><div class="cd-stat-value">{{ $active->count() }}</div></div>
            <div class="cd-stat-icon si-blue2"><i class="fas fa-calendar-check"></i></div>
        </div>
        <div class="cd-stat">
            <div><div class="cd-stat-label" data-en="Completed Bookings" data-fr="Terminées">Completed Bookings</div><div class="cd-stat-value">{{ $completed->count() }}</div></div>
            <div class="cd-stat-icon si-green"><i class="fas fa-calendar-check"></i></div>
        </div>
        <div class="cd-stat">
            <div><div class="cd-stat-label" data-en="Pending Bookings" data-fr="En attente">Pending Bookings</div><div class="cd-stat-value">{{ $pending->count() }}</div></div>
            <div class="cd-stat-icon si-yellow"><i class="fas fa-calendar-times"></i></div>
        </div>
    </div>

    {{-- Filter tabs --}}
    <div class="filter-tabs">
        <button class="ftab active" onclick="filterTab('all',this)"><span data-en="All" data-fr="Tous">All</span> <span class="badge">{{ $all->count() }}</span></button>
        <button class="ftab" onclick="filterTab('active',this)"><span data-en="Active" data-fr="Actives">Active</span> <span class="badge">{{ $active->count() }}</span></button>
        <button class="ftab" onclick="filterTab('upcoming',this)"><span data-en="Upcoming" data-fr="À venir">Upcoming</span> <span class="badge">{{ $upcoming->count() }}</span></button>
        <button class="ftab" onclick="filterTab('completed',this)"><span data-en="Completed" data-fr="Terminées">Completed</span> <span class="badge">{{ $completed->count() }}</span></button>
        <button class="ftab" onclick="filterTab('pending',this)"><span data-en="Pending" data-fr="En attente">Pending</span> <span class="badge">{{ $pending->count() }}</span></button>
        <button class="ftab" onclick="filterTab('rejected',this)"><span data-en="Rejected" data-fr="Rejetées">Rejected</span> <span class="badge">{{ $rejected->count() }}</span></button>
    </div>

    {{-- Table --}}
    <div class="cd-panel">
        @if($all->count())
        <div style="overflow-x:auto;-webkit-overflow-scrolling:touch;">
        <table class="cd-table" id="bookingTable">
            <thead>
                <tr>
                    <th><span data-en="Service" data-fr="Service">Service</span></th>
                    <th><span data-en="Type" data-fr="Type">Type</span></th>
                    <th><span data-en="Date" data-fr="Date">Date</span></th>
                    <th><span data-en="Price" data-fr="Prix">Price</span></th>
                    <th><span data-en="Status" data-fr="Statut">Status</span></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($all as $bk)
                @php
                    $today   = now()->toDateString();
                    $bkDate  = substr($bk->date ?? '', 0, 10); // normalize to YYYY-MM-DD
                    if ($bkDate < $today)                               $status = 'completed';
                    elseif ($bkDate === $today && $bk->approved)        $status = 'active';
                    elseif ($bk->approved)                              $status = 'upcoming';
                    elseif (!is_null($bk->approved) && !$bk->approved)  $status = 'rejected';
                    else                                                $status = 'pending';
                @endphp
                <tr data-status="{{ $status }}">
                    <td><strong>{{ $bk->service }}</strong></td>
                    <td>{{ $bk->name }}</td>
                    <td>{{ $bkDate ? \Carbon\Carbon::parse($bkDate)->format('d F Y') : '—' }}</td>
                    <td>$ {{ number_format($bk->price) }}</td>
                    <td>
                        @if($status === 'completed')
                            <span class="cd-badge badge-completed">Completed</span>
                        @elseif($status === 'rejected')
                            <span class="cd-badge badge-rejected">Rejected</span>
                        @elseif($bk->approved)
                            <span class="cd-badge badge-confirmed">Confirmed</span>
                        @else
                            <span class="cd-badge badge-pending">Pending</span>
                        @endif
                    </td>
                    <td><a href="#" class="cd-link">View Details</a></td>
                </tr>
                @endforeach
                <tr id="noResultsRow" style="display:none;">
                    <td colspan="6" style="text-align:center;padding:40px 20px;color:#aaa;font-size:14px;">
                        <i class="fas fa-search" style="font-size:24px;display:block;margin-bottom:10px;"></i>
                        No bookings match your search.
                    </td>
                </tr>
            </tbody>
        </table>
        </div>

        {{-- Pagination --}}
        <div class="cd-pagination" id="pagination"></div>

        @else
        <div class="no-data">
            <i class="fas fa-suitcase" style="font-size:32px;display:block;margin-bottom:12px;color:#ddd;"></i>
            <span data-en="No bookings found." data-fr="Aucune réservation trouvée.">No bookings found.</span>
        </div>
        @endif
    </div>

@endsection

@section('scripts')
<script>
var currentFilter = 'all';
var rowsPerPage   = 7;
var currentPage   = 1;

function dataRows() {
    // all real booking rows (exclude the no-results placeholder)
    return Array.from(document.querySelectorAll('#bookingTable tbody tr:not(#noResultsRow)'));
}

function getSearch() {
    var el = document.getElementById('searchInput');
    return el ? el.value.trim().toLowerCase() : '';
}

function visibleRows() {
    var search = getSearch();
    return dataRows().filter(function(r) {
        if (currentFilter !== 'all' && r.dataset.status !== currentFilter) return false;
        if (search && !r.textContent.toLowerCase().includes(search)) return false;
        return true;
    });
}

function renderPage() {
    var rows  = visibleRows();
    var total = rows.length;
    var pages = Math.max(1, Math.ceil(total / rowsPerPage));
    if (currentPage > pages) currentPage = 1;

    // Hide all data rows first
    dataRows().forEach(function(r) { r.style.display = 'none'; });

    // Show current page slice
    var start = (currentPage - 1) * rowsPerPage;
    rows.slice(start, start + rowsPerPage).forEach(function(r) { r.style.display = ''; });

    // No-results placeholder
    var noRow = document.getElementById('noResultsRow');
    if (noRow) noRow.style.display = total === 0 ? '' : 'none';

    // Pagination
    var pg = document.getElementById('pagination');
    if (!pg) return;
    var html = '';
    if (currentPage > 1)
        html += '<a class="pg-btn pg-arrow" onclick="goPage(' + (currentPage - 1) + '">&#8249;</a>';
    for (var i = 1; i <= pages; i++) {
        html += '<a class="pg-btn' + (i === currentPage ? ' active' : '') + '" onclick="goPage(' + i + ')">' + i + '</a>';
    }
    if (currentPage < pages)
        html += '<a class="pg-btn pg-arrow" onclick="goPage(' + (currentPage + 1) + ')">&#8250;</a>';
    pg.innerHTML = html;
}

function filterTab(status, el) {
    currentFilter = status;
    currentPage   = 1;
    document.querySelectorAll('.ftab').forEach(function(t) { t.classList.remove('active'); });
    el.classList.add('active');
    renderPage();
}

function goPage(p) { currentPage = p; renderPage(); }

document.addEventListener('DOMContentLoaded', function () {
    renderPage();
    var inp = document.getElementById('searchInput');
    if (inp) {
        inp.addEventListener('input', function () { currentPage = 1; renderPage(); });
    }
});
</script>
@endsection

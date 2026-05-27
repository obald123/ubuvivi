@extends('layouts.client')

@section('title')
    Client Dashboard
@endsection

@section('css')
<style>
    /* ── Top bar ── */
    .cd-topbar {
        display: flex; align-items: center;
        justify-content: space-between;
        margin-bottom: 24px; gap: 14px; flex-wrap: wrap;
    }
    .cd-search {
        display: flex; align-items: center; gap: 10px;
        background: #fff; border: 1px solid #e4e4e8;
        border-radius: 10px; padding: 10px 18px;
        flex: 1; max-width: 480px;
    }
    .cd-search i { color: #bbb; font-size: 14px; }
    .cd-search input {
        border: none; outline: none; background: transparent;
        font-size: 14px; color: #333; width: 100%;
    }
    .cd-search input::placeholder { color: #bbb; }
    .cd-new-btn {
        background: #0D1F35; color: #fff; border: none;
        border-radius: 50px; padding: 10px 22px;
        font-size: 14px; font-weight: 600; cursor: pointer;
        display: inline-flex; align-items: center; gap: 7px;
        white-space: nowrap; transition: background .2s;
        text-decoration: none;
    }
    .cd-new-btn:hover { background: #1e3a5f; color: #fff; text-decoration: none; }

    /* ── Stats bar ── */
    .cd-stats-bar {
        background: #fff; border-radius: 16px;
        box-shadow: 0 1px 8px rgba(0,0,0,.06);
        display: flex; align-items: stretch;
        margin-bottom: 24px; overflow: hidden;
    }
    .cd-stat {
        flex: 1; display: flex; align-items: center;
        justify-content: space-between;
        padding: 22px 28px;
        border-right: 1px solid #f0f0f0;
    }
    .cd-stat:last-child { border-right: none; }
    .cd-stat-label { font-size: 12px; color: #888; font-weight: 500; margin-bottom: 6px; }
    .cd-stat-value { font-size: 30px; font-weight: 800; color: #1a1a2e; line-height: 1; }
    .cd-stat-icon {
        width: 48px; height: 48px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; flex-shrink: 0;
    }
    .si-blue   { background: #EEF2FF; color: #4F6CDE; }
    .si-blue2  { background: #E8EFFE; color: #6B82F5; }
    .si-green  { background: #E8F8F0; color: #27AE60; }
    .si-yellow { background: #FFF8E6; color: #F0A500; }

    /* ── Panels ── */
    .cd-panel {
        background: #fff; border-radius: 16px;
        box-shadow: 0 1px 8px rgba(0,0,0,.06);
        padding: 24px 28px; margin-bottom: 24px;
    }
    .cd-panel-title {
        font-size: 16px; font-weight: 700; color: #1a1a2e;
        margin-bottom: 18px;
    }

    /* ── Table ── */
    .cd-table { width: 100%; border-collapse: collapse; }
    .cd-table th {
        text-align: left; font-size: 13px; font-weight: 600;
        color: #888; padding: 10px 14px;
        border-bottom: 1px solid #f0f0f0;
    }
    .cd-table td {
        padding: 14px 14px; font-size: 14px; color: #1a1a2e;
        border-bottom: 1px solid #f7f7f7; vertical-align: middle;
    }
    .cd-table tr:last-child td { border-bottom: none; }
    .cd-table tr:hover td { background: #fafafa; }
    .cd-badge {
        display: inline-block; padding: 4px 12px;
        border-radius: 20px; font-size: 12px; font-weight: 500;
    }
    .badge-confirmed { background: #E8F8F0; color: #27AE60; }
    .badge-pending   { background: #FFF8E6; color: #F0A500; }
    .badge-completed { background: #E8F8F0; color: #27AE60; }
    .cd-view-link {
        color: #4F9DE8; font-size: 13px; font-weight: 500;
        text-decoration: none;
    }
    .cd-view-link:hover { text-decoration: underline; }

    /* ── Bottom row ── */
    .cd-bottom-row {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 24px; align-items: start;
    }

    /* Recent Bookings */
    .rb-item {
        display: flex; align-items: center;
        justify-content: space-between;
        padding: 15px 18px; border: 1px solid #f0f0f0;
        border-radius: 10px; margin-bottom: 10px;
        transition: background .2s;
    }
    .rb-item:last-child { margin-bottom: 0; }
    .rb-item:hover { background: #fafafa; }
    .rb-title { font-size: 14px; font-weight: 600; color: #1a1a2e; margin-bottom: 3px; }
    .rb-date  { font-size: 12px; color: #aaa; }
    .no-data  { text-align: center; color: #bbb; padding: 24px 0; font-size: 14px; }

    /* ── Calendar ── */
    .cal-header {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 16px;
    }
    .cal-month-title { font-size: 14px; font-weight: 700; color: #1a1a2e; }
    .cal-arrow {
        background: none; border: 1px solid #e8e8e8;
        border-radius: 8px; width: 28px; height: 28px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: #666; font-size: 16px;
        transition: background .2s;
    }
    .cal-arrow:hover { background: #f0f0f0; }
    .cal-grid { width: 100%; border-collapse: collapse; text-align: center; }
    .cal-grid th {
        font-size: 11px; font-weight: 600; color: #aaa;
        padding: 3px 0 8px;
    }
    .cal-grid td { padding: 3px 1px; }
    .cal-day {
        display: inline-flex; align-items: center; justify-content: center;
        width: 30px; height: 30px; border-radius: 50%;
        font-size: 12px; color: #1a1a2e; cursor: default;
        transition: background .15s;
    }
    .cal-day.other  { color: #ccc; }
    .cal-day.today  { background: #0D1F35; color: #fff; font-weight: 700; }
    .cal-day.booked { background: #2563EB; color: #fff; font-weight: 600; }
    .cal-day.range  { background: #EEF2FF; color: #4F6CDE; font-weight: 500; }

    @media (max-width: 991px) {
        .cd-bottom-row { grid-template-columns: 1fr; }
        .cd-stats-bar { flex-wrap: wrap; }
        .cd-stat { flex: 1 1 48%; border-right: none; border-bottom: 1px solid #f0f0f0; }
        .cd-stat:last-child { border-bottom: none; }
    }
    @media (max-width: 767px) {
        .cd-stats-bar { flex-direction: column; }
        .cd-stat { flex: unset; width: 100%; }
        .cd-topbar { flex-direction: column; align-items: stretch; gap: 12px; }
        .cd-search { max-width: 100%; }
    }
    @media (max-width: 576px) {
        .cd-topbar { flex-direction: column; align-items: stretch; }
        .cd-search { max-width: 100%; }
    }
</style>
@endsection

@section('content')

    {{-- ── Topbar ── --}}
    <div class="cd-topbar">
        <div class="cd-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search...">
        </div>
        <a href="{{ url('/tours') }}" class="cd-new-btn">
            <i class="fas fa-plus"></i> New Booking
        </a>
    </div>

    {{-- ── Stats bar ── --}}
    <div class="cd-stats-bar">
        <div class="cd-stat">
            <div>
                <div class="cd-stat-label">Upcoming Bookings</div>
                <div class="cd-stat-value">{{ $upcoming->count() }}</div>
            </div>
            <div class="cd-stat-icon si-blue"><i class="fas fa-calendar-alt"></i></div>
        </div>
        <div class="cd-stat">
            <div>
                <div class="cd-stat-label">Active Bookings</div>
                <div class="cd-stat-value">{{ $active->count() }}</div>
            </div>
            <div class="cd-stat-icon si-blue2"><i class="fas fa-calendar-check"></i></div>
        </div>
        <div class="cd-stat">
            <div>
                <div class="cd-stat-label">Completed Bookings</div>
                <div class="cd-stat-value">{{ $completed->count() }}</div>
            </div>
            <div class="cd-stat-icon si-green"><i class="fas fa-calendar-check"></i></div>
        </div>
        <div class="cd-stat">
            <div>
                <div class="cd-stat-label">Pending Bookings</div>
                <div class="cd-stat-value">{{ $pending->count() }}</div>
            </div>
            <div class="cd-stat-icon si-yellow"><i class="fas fa-calendar-times"></i></div>
        </div>
    </div>

    {{-- ── Upcoming Bookings table ── --}}
    <div class="cd-panel">
        <div class="cd-panel-title">Upcoming Bookings</div>
        @if($upcoming->count())
        <div style="overflow-x:auto;-webkit-overflow-scrolling:touch;">
        <table class="cd-table">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($upcoming->take(5) as $bk)
                <tr>
                    <td><strong>{{ $bk->service }}</strong></td>
                    <td>{{ $bk->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($bk->date)->format('d F Y') }}</td>
                    <td>$ {{ number_format($bk->price) }}</td>
                    <td>
                        @if($bk->approved)
                            <span class="cd-badge badge-confirmed">Confirmed</span>
                        @else
                            <span class="cd-badge badge-pending">Pending</span>
                        @endif
                    </td>
                    <td><a href="#" class="cd-view-link">View Details</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        @else
        <div class="no-data">No upcoming bookings found.</div>
        @endif
    </div>

    {{-- ── Bottom row ── --}}
    <div class="cd-bottom-row">

        {{-- Recent Bookings --}}
        <div class="cd-panel" style="margin-bottom:0;">
            <div class="cd-panel-title">Recent Bookings</div>
            @forelse($recentBookings as $bk)
            <div class="rb-item">
                <div>
                    <div class="rb-title">{{ $bk->service }}: {{ $bk->name }}</div>
                    <div class="rb-date">{{ \Carbon\Carbon::parse($bk->date)->format('d F Y') }}</div>
                </div>
                @if($bk->date < now()->toDateString())
                    <span class="cd-badge badge-completed">Completed</span>
                @elseif($bk->approved)
                    <span class="cd-badge badge-confirmed">Confirmed</span>
                @else
                    <span class="cd-badge badge-pending">Pending</span>
                @endif
            </div>
            @empty
            <div class="no-data">
                <i class="fas fa-suitcase" style="font-size:28px;display:block;margin-bottom:10px;color:#ddd;"></i>
                No bookings yet. <a href="{{ url('/tours') }}" style="color:#4F9DE8;">Browse Tours</a>
            </div>
            @endforelse
        </div>

        {{-- Event Calendar --}}
        <div class="cd-panel" style="margin-bottom:0;">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:18px;">
                <i class="fas fa-calendar-alt" style="color:#4F6CDE;font-size:15px;"></i>
                <span style="font-size:15px;font-weight:700;color:#1a1a2e;">Event Calendar</span>
            </div>
            <div class="cal-header">
                <button class="cal-arrow" onclick="calNav(-1)">&#8249;</button>
                <span class="cal-month-title" id="calTitle"></span>
                <button class="cal-arrow" onclick="calNav(1)">&#8250;</button>
            </div>
            <table class="cal-grid">
                <thead>
                    <tr><th>SU</th><th>MO</th><th>TU</th><th>WE</th><th>TH</th><th>FR</th><th>SA</th></tr>
                </thead>
                <tbody id="calBody"></tbody>
            </table>
        </div>

    </div>

@endsection

@section('scripts')
<script>
(function () {
    var bookingDates = @json($bookingDates);
    var todayStr = new Date().toISOString().slice(0, 10);
    var cur = new Date();
    cur.setDate(1);

    var MONTHS = ['January','February','March','April','May','June',
                  'July','August','September','October','November','December'];

    function pad(n) { return String(n).padStart(2, '0'); }

    function render() {
        var y = cur.getFullYear(), m = cur.getMonth();
        document.getElementById('calTitle').textContent = MONTHS[m] + ' ' + y;

        var firstDay  = new Date(y, m, 1).getDay();
        var daysInMon = new Date(y, m + 1, 0).getDate();
        var prevDays  = new Date(y, m, 0).getDate();
        var html = '', d = 1, extra = 1;

        for (var r = 0; r < 6; r++) {
            html += '<tr>';
            for (var c = 0; c < 7; c++) {
                var cell = r * 7 + c;
                if (cell < firstDay) {
                    html += '<td><span class="cal-day other">' + (prevDays - firstDay + c + 1) + '</span></td>';
                } else if (d > daysInMon) {
                    html += '<td><span class="cal-day other">' + (extra++) + '</span></td>';
                } else {
                    var ds = y + '-' + pad(m + 1) + '-' + pad(d);
                    var cls = 'cal-day';
                    if (ds === todayStr)                       cls += ' today';
                    else if (bookingDates.indexOf(ds) !== -1) cls += ' booked';
                    html += '<td><span class="' + cls + '">' + d + '</span></td>';
                    d++;
                }
            }
            html += '</tr>';
            if (d > daysInMon && r >= 3) break;
        }
        document.getElementById('calBody').innerHTML = html;
    }

    window.calNav = function (dir) {
        cur.setMonth(cur.getMonth() + dir);
        render();
    };

    render();
})();
</script>
@endsection

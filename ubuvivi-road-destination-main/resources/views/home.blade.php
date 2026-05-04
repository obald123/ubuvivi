@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('css')
<style>
    /* ── Page wrapper ── */
    .dash-wrap { padding: 0; }

    /* ── Top bar ── */
    .dash-topbar {
        display: flex; align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
        flex-wrap: wrap; gap: 14px;
    }
    .dash-topbar h1 {
        font-size: 28px; font-weight: 800;
        color: #1a1a2e; margin: 0;
    }
    .dash-topbar-right {
        display: flex; align-items: center; gap: 14px;
    }
    .dash-search {
        display: flex; align-items: center;
        background: #fff; border: 1px solid #e8e8e8;
        border-radius: 10px; padding: 8px 16px;
        gap: 10px; width: 260px;
    }
    .dash-search i { color: #bbb; font-size: 14px; }
    .dash-search input {
        border: none; outline: none; background: transparent;
        font-size: 14px; color: #333; width: 100%;
    }
    .dash-search input::placeholder { color: #bbb; }
    .dash-bell {
        width: 40px; height: 40px; border-radius: 50%;
        background: #fff; border: 1px solid #e8e8e8;
        display: flex; align-items: center; justify-content: center;
        color: #555; cursor: pointer; position: relative;
        transition: background .2s;
    }
    .dash-bell:hover { background: #f5f5f5; }
    .dash-bell-dot {
        position: absolute; top: 9px; right: 9px;
        width: 8px; height: 8px; border-radius: 50%;
        background: #e74c3c; border: 2px solid #fff;
    }
    .dash-avatar {
        width: 40px; height: 40px; border-radius: 50%;
        background: #1a1a2e; color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-size: 15px; font-weight: 700; cursor: pointer;
    }

    /* ── Stat cards ── */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px; margin-bottom: 28px;
    }
    .stat-card {
        background: #fff; border-radius: 14px;
        padding: 22px 24px;
        box-shadow: 0 1px 8px rgba(0,0,0,.06);
        display: flex; align-items: center;
        justify-content: space-between;
        transition: box-shadow .2s;
    }
    .stat-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,.1); }
    .stat-left {}
    .stat-label {
        font-size: 13px; color: #888;
        margin-bottom: 6px; font-weight: 500;
    }
    .stat-value {
        font-size: 32px; font-weight: 800;
        color: #1a1a2e; line-height: 1;
    }
    .stat-icon-sq {
        width: 52px; height: 52px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px; flex-shrink: 0;
    }
    .stat-icon-blue   { background: #EEF2FF; color: #4F6CDE; }
    .stat-icon-green  { background: #E8F8F0; color: #27AE60; }
    .stat-icon-yellow { background: #FFF8E6; color: #F0A500; }
    .stat-icon-purple { background: #F3EEFF; color: #7B5EE8; }

    /* ── Two-column section ── */
    .dash-cols {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px; margin-bottom: 28px;
    }
    .dash-panel {
        background: #fff; border-radius: 14px;
        padding: 22px 24px;
        box-shadow: 0 1px 8px rgba(0,0,0,.06);
    }
    .dash-panel-header {
        display: flex; align-items: center;
        justify-content: space-between; margin-bottom: 18px;
    }
    .dash-panel-header h3 {
        font-size: 16px; font-weight: 700;
        color: #1a1a2e; margin: 0;
    }
    .dash-panel-header a {
        font-size: 13px; color: #4F9DE8;
        text-decoration: none; font-weight: 500;
    }
    .dash-panel-header a:hover { text-decoration: underline; }

    /* Booking row */
    .booking-row {
        border: 1px solid #f0f0f0; border-radius: 10px;
        padding: 14px 18px; margin-bottom: 10px;
        transition: background .2s;
    }
    .booking-row:last-child { margin-bottom: 0; }
    .booking-row:hover { background: #fafafa; }
    .booking-row-top {
        display: flex; align-items: flex-start;
        justify-content: space-between; gap: 10px;
        margin-bottom: 5px;
    }
    .booking-row-name {
        font-size: 15px; font-weight: 600;
        color: #1a1a2e; line-height: 1.3;
    }
    .booking-row-date {
        font-size: 13px; color: #4F9DE8;
        font-weight: 500; white-space: nowrap; flex-shrink: 0;
    }
    .booking-row-sub {
        font-size: 13px; color: #999;
    }
    .no-data-msg {
        text-align: center; color: #bbb;
        font-size: 14px; padding: 24px 0;
    }

    /* ── Chart panel ── */
    .chart-panel {
        background: #fff; border-radius: 14px;
        padding: 24px 28px;
        box-shadow: 0 1px 8px rgba(0,0,0,.06);
        margin-bottom: 24px;
    }
    .chart-panel h3 {
        font-size: 16px; font-weight: 700;
        color: #1a1a2e; margin: 0 0 22px 0;
    }
    .chart-panel canvas { max-height: 280px; }

    /* ── Responsive ── */
    @media (max-width: 1100px) {
        .stats-row { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .stats-row { grid-template-columns: 1fr; }
        .dash-cols { grid-template-columns: 1fr; }
        .dash-search { width: 180px; }
    }
</style>
@endsection

@section('content')
<div class="dash-wrap">

    {{-- ── Top bar ── --}}
    <div class="dash-topbar">
        <h1>Dashboard</h1>
        <div class="dash-topbar-right">
            <div class="dash-search">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search...">
            </div>
            <div class="dash-bell">
                <i class="fas fa-bell"></i>
                <span class="dash-bell-dot"></span>
            </div>
            <div class="dash-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
        </div>
    </div>

    {{-- ── Stats ── --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-left">
                <div class="stat-label">Total Bookings</div>
                <div class="stat-value">{{ $totalBookings }}</div>
            </div>
            <div class="stat-icon-sq stat-icon-blue">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-left">
                <div class="stat-label">Active Services</div>
                <div class="stat-value">{{ $activeServices }}</div>
            </div>
            <div class="stat-icon-sq stat-icon-blue">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-left">
                <div class="stat-label">Total Clients</div>
                <div class="stat-value">{{ $totalClients }}</div>
            </div>
            <div class="stat-icon-sq stat-icon-green">
                <i class="fas fa-user-friends"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-left">
                <div class="stat-label">Pending Requests</div>
                <div class="stat-value">{{ $pendingRequests }}</div>
            </div>
            <div class="stat-icon-sq stat-icon-yellow">
                <i class="fas fa-calendar-times"></i>
            </div>
        </div>
    </div>

    {{-- ── Recent Requests + Upcoming Bookings ── --}}
    <div class="dash-cols">
        {{-- Recent Requests --}}
        <div class="dash-panel">
            <div class="dash-panel-header">
                <h3>Recent Requests</h3>
                <a href="{{ route('requests.index') }}">View all</a>
            </div>
            @forelse($recentRequests as $req)
            <div class="booking-row">
                <div class="booking-row-top">
                    <div class="booking-row-name">{{ $req['name'] }}: {{ $req['service'] }}</div>
                    <div class="booking-row-date">{{ $req['date'] }}</div>
                </div>
                <div class="booking-row-sub">{{ $req['sub'] }}</div>
            </div>
            @empty
            <div class="no-data-msg"><i class="fas fa-inbox" style="font-size:24px;display:block;margin-bottom:8px;"></i>No recent requests</div>
            @endforelse
        </div>

        {{-- Upcoming Bookings --}}
        <div class="dash-panel">
            <div class="dash-panel-header">
                <h3>Upcoming Bookings</h3>
                <a href="{{ route('bookings.index') }}">View all</a>
            </div>
            @forelse($upcomingBookings as $bk)
            <div class="booking-row">
                <div class="booking-row-top">
                    <div class="booking-row-name">{{ $bk['name'] }}: {{ $bk['service'] }}</div>
                    <div class="booking-row-date">{{ $bk['date'] }}</div>
                </div>
                <div class="booking-row-sub">{{ $bk['sub'] }}</div>
            </div>
            @empty
            <div class="no-data-msg"><i class="fas fa-calendar-alt" style="font-size:24px;display:block;margin-bottom:8px;"></i>No upcoming bookings</div>
            @endforelse
        </div>
    </div>

    {{-- ── Service Performance Chart ── --}}
    <div class="chart-panel">
        <h3>Service Performance</h3>
        <canvas id="perfChart"></canvas>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function () {
    var chartData = @json($chartData);
    var labels = chartData.map(function(d){ return d.month; });
    var counts  = chartData.map(function(d){ return d.count; });

    var ctx = document.getElementById('perfChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Bookings',
                data: counts,
                borderColor: '#4F6CDE',
                backgroundColor: 'rgba(79, 108, 222, 0.12)',
                borderWidth: 2.5,
                tension: 0.42,
                fill: true,
                pointBackgroundColor: '#4F6CDE',
                pointRadius: 5,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1a1a2e',
                    titleColor: '#fff',
                    bodyColor: '#ccc',
                    padding: 10,
                    cornerRadius: 8,
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#999', font: { size: 12 } },
                    border: { display: false }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: '#f0f0f0', drawBorder: false },
                    ticks: { color: '#999', font: { size: 12 }, stepSize: 40 },
                    border: { display: false }
                }
            }
        }
    });
})();
</script>
@endsection

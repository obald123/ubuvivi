@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('css')
<style>
    .dash-page {
        display: flex;
        flex-direction: column;
        gap: 24px;
        width: 100%;
        max-width: 1110px;
        margin: 0 auto;
        --admin-search-width: 398px;
    }

    .dash-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
    }

    .dash-topbar h1 {
        margin: 0;
        color: #2d313d;
        font-size: 28px;
        font-weight: 700;
        letter-spacing: -.02em;
    }

    .dash-topbar-right {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-left: auto;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .dash-search {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 440px;
        padding: 0 14px;
        height: 46px;
        background: #fff;
        border: 1px solid #dfe4ee;
        border-radius: 4px;
    }

    .dash-search i {
        color: #b5bfcc;
        font-size: 14px;
    }

    .dash-search input {
        width: 100%;
        border: 0;
        outline: 0;
        background: transparent;
        color: #4b5563;
        font-size: 14px;
    }

    .dash-search input::placeholder {
        color: #b5bfcc;
    }

    .dash-icon-btn,
    .dash-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .dash-icon-btn {
        position: relative;
        background: transparent;
        border: 0;
        color: #23384d;
        font-size: 16px;
    }

    .dash-icon-dot {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #ef4444;
        border: 2px solid #f5f6fb;
    }

    .dash-avatar {
        background: #122c3b;
        color: #fff;
        font-size: 20px;
        font-weight: 700;
    }

    .stats-shell,
    .panel-card,
    .chart-card {
        background: #fff;
        border: 1px solid #e4e8f0;
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(15, 35, 52, .04);
    }

    .stats-shell {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        overflow: hidden;
    }

    .stat-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 26px 26px 24px;
    }

    .stat-card + .stat-card {
        border-left: 1px solid #edf1f6;
    }

    .stat-label {
        margin-bottom: 8px;
        color: #555f6d;
        font-size: 13px;
        font-weight: 500;
    }

    .stat-value {
        color: #0c5c80;
        font-size: 36px;
        font-weight: 700;
        line-height: 1;
    }

    .stat-icon {
        width: 34px;
        height: 34px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .stat-icon.blue {
        color: #4a73e8;
        background: #e8efff;
    }

    .stat-icon.purple {
        color: #6962f8;
        background: #ecebff;
    }

    .stat-icon.green {
        color: #28b463;
        background: #ddfae8;
    }

    .stat-icon.gold {
        color: #d39a08;
        background: #fff2bf;
    }

    .panel-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .panel-card {
        padding: 0 0 10px;
        min-height: 220px;
    }

    .panel-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 18px 8px;
        gap: 12px;
    }

    .panel-head h2 {
        margin: 0;
        color: #183247;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: -.02em;
    }

    .panel-head a {
        color: #2784ca;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
    }

    .panel-list {
        padding: 0 12px 10px;
    }

    .panel-item {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        padding: 14px 14px 12px;
        border: 1px solid #edf1f6;
        border-radius: 8px;
        margin-bottom: 10px;
        background: #fff;
    }

    .panel-item:last-child {
        margin-bottom: 0;
    }

    .panel-title {
        color: #2d313d;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.4;
    }

    .panel-meta {
        margin-top: 5px;
        color: #4a5565;
        font-size: 13px;
        line-height: 1.5;
    }

    .panel-date {
        color: #2784ca;
        font-size: 13px;
        font-weight: 500;
        white-space: nowrap;
        padding-top: 2px;
    }

    .empty-state {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 150px;
        padding: 44px 20px;
        color: #a7b1bf;
        text-align: center;
        font-size: 14px;
    }

    .chart-card {
        padding: 16px 18px 12px;
    }

    .chart-card h2 {
        margin: 0 0 12px;
        color: #183247;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: -.02em;
    }

    .chart-shell {
        height: 330px;
    }

    .chart-shell canvas {
        width: 100% !important;
        height: 100% !important;
    }

    @media (max-width: 1199px) {
        .stats-shell {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .stat-card:nth-child(3) {
            border-left: 0;
            border-top: 1px solid #edf1f6;
        }

        .stat-card:nth-child(4) {
            border-top: 1px solid #edf1f6;
        }
    }

    @media (max-width: 991px) {
        .panel-grid {
            grid-template-columns: 1fr;
        }

        .dash-search {
            min-width: 280px;
        }
    }

    @media (max-width: 767px) {
        .dash-topbar-right {
            width: 100%;
        }

        .dash-search {
            min-width: 0;
            width: 100%;
        }

        .stats-shell {
            grid-template-columns: 1fr;
        }

        .stat-card + .stat-card,
        .stat-card:nth-child(3),
        .stat-card:nth-child(4) {
            border-left: 0;
            border-top: 1px solid #edf1f6;
        }

        .panel-item {
            flex-direction: column;
        }

        .panel-date {
            white-space: normal;
        }
    }
</style>
@endsection

@section('content')
<div class="dash-page">
    @include('layouts.partials.admin_topbar', [
        'title' => 'Dashboard',
        'searchInputId' => 'dashboardSearch',
        'searchAriaLabel' => 'Search dashboard',
    ])

    <section class="stats-shell">
        <article class="stat-card">
            <div>
                <div class="stat-label">Total Bookings</div>
                <div class="stat-value">{{ $totalBookings }}</div>
            </div>
            <span class="stat-icon blue"><i class="far fa-calendar-alt"></i></span>
        </article>
        <article class="stat-card">
            <div>
                <div class="stat-label">Active Services</div>
                <div class="stat-value">{{ $activeServices }}</div>
            </div>
            <span class="stat-icon purple"><i class="fas fa-briefcase"></i></span>
        </article>
        <article class="stat-card">
            <div>
                <div class="stat-label">Total Clients</div>
                <div class="stat-value">{{ $totalClients }}</div>
            </div>
            <span class="stat-icon green"><i class="fas fa-users"></i></span>
        </article>
        <article class="stat-card">
            <div>
                <div class="stat-label">Pending Requests</div>
                <div class="stat-value">{{ $pendingRequests }}</div>
            </div>
            <span class="stat-icon gold"><i class="far fa-calendar-check"></i></span>
        </article>
    </section>

    <section class="panel-grid">
        <article class="panel-card">
            <div class="panel-head">
                <h2>Recent Requests</h2>
                <a href="{{ route('requests.index') }}">View all</a>
            </div>
            <div class="panel-list">
                @forelse($recentRequests as $req)
                    <div class="panel-item">
                        <div>
                            <div class="panel-title">{{ $req['name'] }}: {{ $req['service'] }}</div>
                            <div class="panel-meta">{{ $req['sub'] }}</div>
                        </div>
                        <div class="panel-date">
                            {{ $req['date'] ? \Carbon\Carbon::parse($req['date'])->format('d F Y') : 'Date pending' }}
                        </div>
                    </div>
                @empty
                    <div class="empty-state">No recent requests yet.</div>
                @endforelse
            </div>
        </article>

        <article class="panel-card">
            <div class="panel-head">
                <h2>Upcoming Bookings</h2>
                <a href="{{ route('bookings.index') }}">View all</a>
            </div>
            <div class="panel-list">
                @forelse($upcomingBookings as $bk)
                    <div class="panel-item">
                        <div>
                            <div class="panel-title">{{ $bk['name'] }}: {{ $bk['service'] }}</div>
                            <div class="panel-meta">{{ $bk['sub'] }}</div>
                        </div>
                        <div class="panel-date">
                            {{ $bk['date'] ? \Carbon\Carbon::parse($bk['date'])->format('d F Y') : 'Date pending' }}
                        </div>
                    </div>
                @empty
                    <div class="empty-state">No upcoming bookings yet.</div>
                @endforelse
            </div>
        </article>
    </section>

    <section class="chart-card">
        <h2>Service Performance</h2>
        <div class="chart-shell">
            <canvas id="perfChart"></canvas>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function () {
    var chartData = @json($chartData);
    var labels = chartData.map(function (item) { return item.month; });
    var counts = chartData.map(function (item) { return Number(item.count || 0); });
    var peak = counts.length ? Math.max.apply(null, counts) : 0;
    var suggestedMax = peak ? Math.ceil((peak + 20) / 20) * 20 : 120;
    var stepSize = Math.max(20, Math.ceil((suggestedMax / 5) / 10) * 10);

    var canvas = document.getElementById('perfChart');
    if (!canvas) {
        return;
    }

    var context = canvas.getContext('2d');
    var gradient = context.createLinearGradient(0, 0, 0, 320);
    gradient.addColorStop(0, 'rgba(95, 115, 255, 0.16)');
    gradient.addColorStop(.55, 'rgba(136, 95, 255, 0.08)');
    gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');

    new Chart(context, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                data: counts,
                fill: true,
                backgroundColor: gradient,
                borderColor: '#0f5f86',
                borderWidth: 3,
                tension: .34,
                pointRadius: 3,
                pointHoverRadius: 4,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#0f5f86',
                pointBorderWidth: 1.5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#122c3b',
                    titleColor: '#fff',
                    bodyColor: '#d9e4ec',
                    displayColors: false,
                    padding: 12,
                    cornerRadius: 10
                }
            },
            scales: {
                x: {
                    grid: {
                        color: '#edf1f6',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            family: 'Poppins',
                            size: 12
                        }
                    },
                    border: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    suggestedMax: suggestedMax,
                    ticks: {
                        color: '#6b7280',
                        stepSize: stepSize,
                        font: {
                            family: 'Poppins',
                            size: 11
                        }
                    },
                    grid: {
                        color: '#edf1f6',
                        drawBorder: false
                    },
                    border: {
                        display: false
                    }
                }
            }
        }
    });
})();
</script>
@endsection

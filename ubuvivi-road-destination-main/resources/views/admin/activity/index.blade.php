@extends('layouts.app')

@section('title')
    Admin Activity
@endsection

@section('css')
    <style>
        .activity-page {
            min-width: 0;
        }

        .activity-filters {
            display: grid;
            grid-template-columns: minmax(240px, 2fr) repeat(2, minmax(160px, 1fr)) auto auto;
            gap: 10px;
            margin-bottom: 20px;
        }

        .activity-filters .form-control {
            min-width: 0;
            height: 44px;
        }

        .activity-filter-btn,
        .activity-clear-btn {
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 18px;
            white-space: nowrap;
        }

        .activity-table-wrap {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .activity-table {
            min-width: 1050px;
            table-layout: fixed;
        }

        .activity-table th,
        .activity-table td {
            padding: 14px 12px;
            vertical-align: middle;
            overflow-wrap: anywhere;
        }

        .activity-table th:nth-child(1) { width: 160px; }
        .activity-table th:nth-child(2) { width: 210px; }
        .activity-table th:nth-child(3) { width: 190px; }
        .activity-table th:nth-child(4) { width: 170px; }
        .activity-table th:nth-child(5) { width: 250px; }
        .activity-table th:nth-child(6) { width: 130px; }

        .activity-table td:first-child,
        .activity-table td:last-child {
            white-space: nowrap;
        }

        .activity-details-button {
            padding: 4px 0;
            border: 0;
            background: transparent;
            color: #0f5f86;
            font: inherit;
            cursor: pointer;
            text-align: left;
        }

        .activity-details-button:hover,
        .activity-details-button:focus {
            text-decoration: underline;
        }

        .activity-details-dialog {
            position: fixed;
            inset: 0;
            z-index: 5000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(10, 24, 35, .62);
        }

        .activity-details-dialog.is-open {
            display: flex;
        }

        .activity-details-panel {
            display: flex;
            flex-direction: column;
            width: min(760px, 100%);
            max-height: min(82vh, 800px);
            overflow: hidden;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .25);
        }

        .activity-details-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 16px 20px;
            border-bottom: 1px solid #e8ecf2;
        }

        .activity-details-head h2 {
            margin: 0;
            color: #182b39;
            font-size: 18px;
            font-weight: 700;
        }

        .activity-details-heading {
            min-width: 0;
        }

        .activity-details-subtitle {
            margin: 3px 0 0;
            color: #6b7280;
            font-size: 12px;
            overflow-wrap: anywhere;
        }

        .activity-details-close {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            min-height: 40px;
            border: 0;
            border-radius: 8px;
            background: #f2f4f7;
            color: #374151;
            font-size: 24px;
            cursor: pointer;
        }

        .activity-details-content {
            min-height: 0;
            overflow: auto;
            background: #fbfcfe;
            padding: 20px;
        }

        .activity-details-section + .activity-details-section {
            margin-top: 22px;
        }

        .activity-details-section h3 {
            margin: 0 0 10px;
            color: #182b39;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .activity-details-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .activity-detail-item {
            min-width: 0;
            padding: 12px 14px;
            border: 1px solid #e6ebf1;
            border-radius: 10px;
            background: #fff;
        }

        .activity-detail-label {
            display: block;
            margin-bottom: 4px;
            color: #6b7280;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .035em;
        }

        .activity-detail-value {
            display: block;
            color: #263746;
            font-size: 13px;
            line-height: 1.5;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .activity-detail-value.is-status {
            color: #147348;
            font-weight: 600;
        }

        .activity-details-empty {
            margin: 0;
            color: #6b7280;
            font-size: 13px;
        }

        .activity-pagination {
            overflow-x: auto;
        }

        @media (max-width: 991px) {
            .activity-filters {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .activity-search-field {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 767px) {
            .activity-filters {
                grid-template-columns: minmax(0, 1fr);
            }

            .activity-search-field {
                grid-column: auto;
            }

            .activity-filters .form-control,
            .activity-filter-btn,
            .activity-clear-btn {
                width: 100%;
            }

            .activity-table-wrap {
                overflow: visible;
                background: transparent !important;
                box-shadow: none !important;
            }

            .activity-table {
                display: block;
                min-width: 0;
                width: 100%;
                border: 0;
            }

            .activity-table thead {
                display: none;
            }

            .activity-table tbody {
                display: grid;
                gap: 12px;
            }

            .activity-table tr {
                display: block;
                padding: 8px 14px;
                border: 1px solid #e2e8f1;
                border-radius: 12px;
                background: #fff;
                box-shadow: 0 6px 18px rgba(18, 44, 59, .05);
            }

            .activity-table td {
                display: grid;
                grid-template-columns: minmax(105px, 0.7fr) minmax(0, 1.3fr);
                gap: 10px;
                width: 100%;
                padding: 10px 0;
                border: 0;
                border-bottom: 1px solid #edf1f6;
                text-align: left;
                overflow-wrap: anywhere;
            }

            .activity-table td:last-child {
                border-bottom: 0;
            }

            .activity-table td::before {
                content: attr(data-label);
                color: #6b7280;
                font-size: 12px;
                font-weight: 600;
            }

            .activity-table td[colspan] {
                display: block;
                border: 0;
                text-align: center;
            }

            .activity-table td[colspan]::before {
                content: none;
            }

            .activity-details-dialog {
                align-items: flex-end;
                padding: 10px;
            }

            .activity-details-panel {
                max-height: 85vh;
                border-radius: 14px 14px 8px 8px;
            }

            .activity-details-content {
                padding: 14px;
            }

            .activity-details-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 8px;
            }

            .activity-detail-item {
                padding: 10px 12px;
            }
        }

        @media (max-width: 400px) {
            .activity-table td {
                grid-template-columns: minmax(82px, 0.65fr) minmax(0, 1.35fr);
                gap: 6px;
                font-size: 12px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="services-page activity-page">
        @include('layouts.partials.admin_topbar', [
            'title' => 'Admin Activity',
            'searchInputId' => 'activitySearch',
            'searchPlaceholder' => 'Search activity...',
            'searchAriaLabel' => 'Search admin activity',
            'showSearch' => false,
        ])

        <form method="GET" action="{{ route('admin.activity.index') }}" class="activity-filters">
            <div class="activity-search-field">
                <input
                    id="activitySearch"
                    type="search"
                    name="search"
                    value="{{ $validated['search'] ?? '' }}"
                    class="form-control"
                    placeholder="Search actor, action, or target">
            </div>
            <div>
                <input type="date" name="from" value="{{ $validated['from'] ?? '' }}" class="form-control" aria-label="From date">
            </div>
            <div>
                <input type="date" name="to" value="{{ $validated['to'] ?? '' }}" class="form-control" aria-label="To date">
            </div>
            <div>
                <button type="submit" class="btn btn-primary activity-filter-btn">Filter</button>
            </div>
            <div>
                <a href="{{ route('admin.activity.index') }}" class="btn btn-outline-secondary activity-clear-btn">Clear</a>
            </div>
        </form>

        <div class="activity-table-wrap table-responsive bg-white rounded shadow-sm">
            <table class="table table-hover mb-0 activity-table">
                <thead>
                    <tr>
                        <th>When</th>
                        <th>Who</th>
                        <th>Action</th>
                        <th>Target</th>
                        <th>Submitted changes</th>
                        <th>IP address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td data-label="When">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                            <td data-label="Who">
                                <strong>{{ $log->actor_name }}</strong><br>
                                <small>{{ $log->actor_email }}</small>
                            </td>
                            <td data-label="Action">{{ $log->action }}</td>
                            <td data-label="Target">{{ $log->target }}</td>
                            <td data-label="Submitted changes">
                                <button
                                    type="button"
                                    class="activity-details-button"
                                    data-details="{{ json_encode($log->details) }}"
                                    aria-haspopup="dialog">
                                    View details
                                </button>
                            </td>
                            <td data-label="IP address">{{ $log->ip_address }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No admin activity recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="activity-pagination mt-3">{{ $logs->links() }}</div>
    </div>

    <div class="activity-details-dialog" id="activityDetailsDialog" aria-hidden="true">
        <section class="activity-details-panel" role="dialog" aria-modal="true" aria-labelledby="activityDetailsTitle">
            <header class="activity-details-head">
                <div class="activity-details-heading">
                    <h2 id="activityDetailsTitle">Activity details</h2>
                    <p class="activity-details-subtitle" id="activityDetailsSubtitle"></p>
                </div>
                <button type="button" class="activity-details-close" aria-label="Close details">&times;</button>
            </header>
            <div class="activity-details-content" id="activityDetailsContent"></div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        (function () {
            var dialog = document.getElementById('activityDetailsDialog');
            var content = document.getElementById('activityDetailsContent');
            var subtitle = document.getElementById('activityDetailsSubtitle');
            var closeButton = dialog.querySelector('.activity-details-close');
            var previousFocus = null;

            function labelFor(key) {
                var labels = {
                    route_parameters: 'Record reference',
                    response_status: 'Result',
                    sort_order: 'Sort order',
                    available: 'Availability',
                    active: 'Active',
                    nearby: 'Nearby destinations',
                    ip_address: 'IP address',
                    user_agent: 'Browser',
                };

                if (labels[key]) return labels[key];

                return key
                    .replace(/([a-z0-9])([A-Z])/g, '$1 $2')
                    .replace(/[_-]+/g, ' ')
                    .replace(/\b\w/g, function (letter) { return letter.toUpperCase(); });
            }

            function formatValue(key, value) {
                if (key === 'response_status') {
                    return Number(value) < 400 ? 'Saved successfully' : 'Request failed (' + value + ')';
                }

                if (Array.isArray(value)) {
                    if (value.length === 0) {
                        return /image|photo|file/i.test(key) ? 'No new files uploaded' : 'None';
                    }
                    return value.map(function (item) {
                        return typeof item === 'object' && item !== null
                            ? JSON.stringify(item)
                            : String(item);
                    }).join(', ');
                }

                if (value === null || value === '') return 'Not provided';
                if (value === 'on' || value === true) return 'Yes';
                if (value === false) return 'No';
                return String(value);
            }

            function appendSection(title, values) {
                if (!values || typeof values !== 'object' || Array.isArray(values)) return;

                var entries = Object.keys(values);
                if (entries.length === 0) return;

                var section = document.createElement('section');
                section.className = 'activity-details-section';

                var heading = document.createElement('h3');
                heading.textContent = title;

                var grid = document.createElement('div');
                grid.className = 'activity-details-grid';

                entries.forEach(function (key) {
                    var item = document.createElement('div');
                    item.className = 'activity-detail-item';

                    var label = document.createElement('span');
                    label.className = 'activity-detail-label';
                    label.textContent = labelFor(key);

                    var value = document.createElement('span');
                    value.className = 'activity-detail-value';
                    if (key === 'response_status') value.classList.add('is-status');
                    value.textContent = formatValue(key, values[key]);

                    item.appendChild(label);
                    item.appendChild(value);
                    grid.appendChild(item);
                });

                section.appendChild(heading);
                section.appendChild(grid);
                content.appendChild(section);
            }

            function closeDialog() {
                dialog.classList.remove('is-open');
                dialog.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
                if (previousFocus) previousFocus.focus();
            }

            document.querySelectorAll('.activity-details-button').forEach(function (button) {
                button.addEventListener('click', function () {
                    var details;
                    try {
                        details = JSON.parse(button.getAttribute('data-details') || '{}');
                    } catch (error) {
                        content.textContent = 'Unable to read the saved activity details.';
                        dialog.classList.add('is-open');
                        dialog.setAttribute('aria-hidden', 'false');
                        return;
                    }

                    while (content.firstChild) content.removeChild(content.firstChild);
                    subtitle.textContent = button.closest('tr').querySelector('[data-label="Action"]').textContent
                        + ' · ' + button.closest('tr').querySelector('[data-label="Target"]').textContent;

                    appendSection('Record reference', details.route_parameters || {});
                    appendSection('Submitted changes', details.input || {});
                    if (details.response_status !== undefined) {
                        appendSection('Request result', { response_status: details.response_status });
                    }

                    if (!content.childElementCount) {
                        var emptyMessage = document.createElement('p');
                        emptyMessage.className = 'activity-details-empty';
                        emptyMessage.textContent = 'There are no additional details for this activity.';
                        content.appendChild(emptyMessage);
                    }

                    previousFocus = button;
                    dialog.classList.add('is-open');
                    dialog.setAttribute('aria-hidden', 'false');
                    document.body.style.overflow = 'hidden';
                    closeButton.focus();
                });
            });

            closeButton.addEventListener('click', closeDialog);
            dialog.addEventListener('click', function (event) {
                if (event.target === dialog) closeDialog();
            });
            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && dialog.classList.contains('is-open')) {
                    closeDialog();
                }
            });
        })();
    </script>
@endsection

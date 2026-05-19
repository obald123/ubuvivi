@extends('layouts.app')

@section('title')
    Bookings
@endsection

@section('css')
<style>
    .book-page {
        display: flex;
        flex-direction: column;
        gap: 22px;
        width: 100%;
        --admin-search-width: 396px;
    }

    .book-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
    }

    .book-topbar h1 {
        margin: 0;
        color: #2d313d;
        font-size: 28px;
        font-weight: 700;
        letter-spacing: -.02em;
    }

    .book-tools {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-left: auto;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .book-search {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 416px;
        height: 46px;
        padding: 0 14px;
        background: #fff;
        border: 1px solid #dfe4ee;
        border-radius: 4px;
    }

    .book-search i {
        color: #b5bfcc;
        font-size: 14px;
    }

    .book-search input {
        width: 100%;
        border: 0;
        outline: 0;
        background: transparent;
        color: #4b5563;
        font-size: 14px;
    }

    .book-search input::placeholder {
        color: #b5bfcc;
    }

    .book-icon-btn,
    .book-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .book-icon-btn {
        position: relative;
        border: 0;
        background: transparent;
        color: #23384d;
    }

    .book-icon-dot {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #ef4444;
        border: 2px solid #f5f6fb;
    }

    .book-avatar {
        background: #122c3b;
        color: #fff;
        font-size: 20px;
        font-weight: 700;
    }

    .filter-shell,
    .table-shell {
        background: #fff;
        border: 1px solid #e4e8f0;
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(15, 35, 52, .04);
    }

    .filter-shell {
        padding: 8px;
        background: #eef1f7;
        border-color: #eef1f7;
        box-shadow: none;
    }

    .filter-row {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
    }

    .filter-tab {
        border: 0;
        background: transparent;
        color: #303747;
        border-radius: 999px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        font-size: 14px;
        font-weight: 600;
        transition: all .18s ease;
    }

    .filter-tab:hover {
        background: #f1f5fb;
    }

    .filter-tab.active {
        color: #fff;
        background: linear-gradient(90deg, #2e9eeb 0%, #3fa9f5 100%);
        box-shadow: 0 10px 24px rgba(46, 158, 235, .24);
    }

    .filter-count {
        min-width: 18px;
        height: 18px;
        padding: 0 5px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #111827;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
    }

    .filter-tab.active .filter-count {
        background: rgba(255, 255, 255, .96);
        color: #2495e7;
    }

    .table-shell {
        overflow: hidden;
    }

    .table-wrap {
        overflow-x: visible;
    }

    .book-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 0;
    }

    .book-table thead th {
        padding: 15px 22px 12px;
        border-bottom: 1px solid #edf1f6;
        color: #5b6573;
        font-size: 13px;
        font-weight: 500;
        text-align: left;
    }

    .book-table tbody td {
        padding: 17px 22px;
        border-bottom: 1px solid #edf1f6;
        color: #2d313d;
        font-size: 14px;
    }

    .book-table th:nth-child(3),
    .book-table th:nth-child(5),
    .book-table th:nth-child(6),
    .book-table td:nth-child(3),
    .book-table td:nth-child(5),
    .book-table td:nth-child(6) {
        white-space: nowrap;
    }

    .book-table th:last-child,
    .book-table td:last-child {
        text-align: right;
    }

    .book-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .book-table tbody tr:hover td {
        background: #fbfcff;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 78px;
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 500;
    }

    .status-pill.completed {
        color: #16a34a;
        background: #dcfce7;
    }

    .status-pill.active {
        color: #d59a08;
        background: #fff1b8;
    }

    .status-pill.upcoming {
        color: #3b82f6;
        background: #dbeafe;
    }

    .status-pill.pending {
        color: #6b7280;
        background: #eceff4;
    }

    .view-link {
        border: 0;
        background: transparent;
        color: #1f6ca7;
        font-size: 13px;
        font-style: italic;
        font-weight: 600;
        padding: 0;
        cursor: pointer;
    }

    .view-link:hover {
        color: #145483;
        text-decoration: underline;
    }

    .table-footer {
        display: flex;
        justify-content: center;
        padding: 20px 18px 24px;
    }

    .pagination-row {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .page-btn {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 0;
        background: #eff1f5;
        color: #5f6b7c;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
    }

    .page-btn.active {
        background: #d9dde5;
        color: #2d313d;
    }

    .page-btn.next-btn {
        background: transparent;
        color: #9aa3b2;
        width: auto;
        border-radius: 0;
    }

    .empty-bookings {
        padding: 42px 24px;
        text-align: center;
        color: #9aa3b2;
        font-size: 14px;
    }

    .detail-overlay {
        position: fixed;
        inset: 0;
        display: none;
        align-items: center;
        justify-content: center;
        background: rgba(15, 42, 56, .45);
        z-index: 2100;
        padding: 18px;
    }

    .detail-modal {
        width: min(560px, 100%);
        max-height: 90vh;
        overflow-y: auto;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 24px 60px rgba(15, 35, 52, .22);
        padding: 22px;
    }

    .detail-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 16px;
    }

    .detail-head h2 {
        margin: 0;
        color: #183247;
        font-size: 20px;
        font-weight: 700;
    }

    .detail-close {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 0;
        background: #f1f5fb;
        color: #526071;
        font-size: 18px;
        cursor: pointer;
    }

    .detail-section {
        border: 1px solid #edf1f6;
        border-radius: 12px;
        padding: 14px 16px;
        margin-bottom: 12px;
    }

    .detail-section:last-child {
        margin-bottom: 0;
    }

    .detail-section h3 {
        margin: 0 0 10px;
        color: #183247;
        font-size: 14px;
        font-weight: 700;
    }

    .detail-row {
        display: flex;
        gap: 12px;
        justify-content: space-between;
        padding: 6px 0;
        border-bottom: 1px dashed #edf1f6;
        font-size: 13px;
    }

    .detail-row:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .detail-label {
        color: #6b7280;
        font-weight: 500;
    }

    .detail-value {
        color: #2d313d;
        font-weight: 500;
        text-align: right;
    }

    @media (max-width: 991px) {
        .book-search { min-width: 260px; }
        .table-wrap { overflow-x: auto; }
        .book-table { min-width: 760px; }
        .filter-row { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }

    @media (max-width: 767px) {
        .book-tools { width: 100%; }
        .book-search { min-width: 0; width: 100%; }
        .filter-row { grid-template-columns: repeat(2, minmax(0, 1fr)); }

        .detail-row {
            flex-direction: column;
            gap: 4px;
        }

        .detail-value {
            text-align: left;
        }
    }
</style>
@endsection

@section('content')
<div class="book-page">
    @include('layouts.partials.admin_topbar', [
        'title' => 'Bookings',
        'searchInputId' => 'searchInput',
        'searchAriaLabel' => 'Search bookings',
    ])

    <section class="filter-shell">
        <div class="filter-row">
            <button class="filter-tab active" data-filter="all">All <span class="filter-count">{{ $allCount }}</span></button>
            <button class="filter-tab" data-filter="active">Active <span class="filter-count">{{ $activeCount }}</span></button>
            <button class="filter-tab" data-filter="upcoming">Upcoming <span class="filter-count">{{ $upcomingCount }}</span></button>
            <button class="filter-tab" data-filter="completed">Completed <span class="filter-count">{{ $completedCount }}</span></button>
        </div>
    </section>

    <section class="table-shell">
        @if($allBookings->count())
            <div class="table-wrap">
                <table class="book-table" id="bookingTable">
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
                        @for($sk=0;$sk<5;$sk++)
                        <tr class="skel-row">
                            <td><span class="skel short"></span></td>
                            <td><span class="skel" style="width:75%;"></span></td>
                            <td><span class="skel short"></span></td>
                            <td><span class="skel short"></span></td>
                            <td><span class="skel short"></span></td>
                            <td><span class="skel" style="width:70px;height:22px;border-radius:50px;"></span></td>
                            <td><span class="skel" style="width:80px;height:28px;border-radius:7px;"></span></td>
                        </tr>
                        @endfor
                        @foreach($allBookings as $bk)
                            <tr data-status="{{ $bk['status_key'] }}">
                                <td>{{ $bk['service'] }}</td>
                                <td>{{ $bk['type'] }}</td>
                                <td>{{ $bk['formatted_date'] }}</td>
                                <td>{{ $bk['client'] }}</td>
                                <td>
                                    <span class="status-pill {{ $bk['status_key'] }}">{{ $bk['status'] }}</span>
                                </td>
                                <td>
                                    <button
                                        class="view-link btn-view"
                                        data-mtype="{{ $bk['model_type'] }}"
                                        data-mid="{{ $bk['model_id'] }}">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="table-footer">
                <div class="pagination-row" id="bookingPagination"></div>
            </div>
        @else
            <div class="empty-bookings">No bookings found.</div>
        @endif
    </section>
</div>

<div class="detail-overlay" id="bookingDetailModal">
    <div class="detail-modal">
        <div class="detail-head">
            <h2>Booking Details</h2>
            <button type="button" class="detail-close" onclick="closeBookingModal()">&times;</button>
        </div>
        <div id="bookingDetailBody"></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
var rowsPerPage = 8;
var currentPage = 1;
var currentFilter = 'all';

function getBookingRows() {
    return Array.from(document.querySelectorAll('#bookingTable tbody tr'));
}

function getVisibleBookingRows() {
    var query = '';
    var searchInput = document.getElementById('searchInput');
    if (searchInput) {
        query = searchInput.value.trim().toLowerCase();
    }

    return getBookingRows().filter(function (row) {
        if (currentFilter !== 'all' && row.dataset.status !== currentFilter) {
            return false;
        }

        if (query && row.textContent.toLowerCase().indexOf(query) === -1) {
            return false;
        }

        return true;
    });
}

function renderBookingRows() {
    var rows = getVisibleBookingRows();
    var pageCount = Math.max(1, Math.ceil(rows.length / rowsPerPage));

    if (currentPage > pageCount) {
        currentPage = 1;
    }

    getBookingRows().forEach(function (row) {
        row.style.display = 'none';
    });

    rows.slice((currentPage - 1) * rowsPerPage, currentPage * rowsPerPage).forEach(function (row) {
        row.style.display = '';
    });

    renderBookingPagination(pageCount);
}

function renderBookingPagination(pageCount) {
    var container = document.getElementById('bookingPagination');
    if (!container) {
        return;
    }

    var buttons = [];
    for (var page = 1; page <= pageCount; page++) {
        buttons.push(
            '<button type="button" class="page-btn' + (page === currentPage ? ' active' : '') + '" onclick="goToBookingPage(' + page + ')">' + page + '</button>'
        );
    }

    if (currentPage < pageCount) {
        buttons.push('<button type="button" class="page-btn next-btn" onclick="goToBookingPage(' + (currentPage + 1) + ')">&gt;</button>');
    }

    container.innerHTML = buttons.join('');
}

function goToBookingPage(page) {
    currentPage = page;
    renderBookingRows();
}

function openBookingModal(data) {
    var body = document.getElementById('bookingDetailBody');
    if (!body) {
        return;
    }

    var optionalRows = '';
    if (data.location) {
        optionalRows += '<div class="detail-row"><span class="detail-label">Location</span><span class="detail-value">' + escapeHtml(data.location) + '</span></div>';
    }
    if (data.destination) {
        optionalRows += '<div class="detail-row"><span class="detail-label">Destination</span><span class="detail-value">' + escapeHtml(data.destination) + '</span></div>';
    }
    if (data.number_of_days) {
        optionalRows += '<div class="detail-row"><span class="detail-label">Days</span><span class="detail-value">' + escapeHtml(String(data.number_of_days)) + '</span></div>';
    }
    if (data.number_of_people) {
        optionalRows += '<div class="detail-row"><span class="detail-label">People</span><span class="detail-value">' + escapeHtml(String(data.number_of_people)) + '</span></div>';
    }
    if (data.price) {
        optionalRows += '<div class="detail-row"><span class="detail-label">Price</span><span class="detail-value">' + escapeHtml(String(data.price)) + '</span></div>';
    }

    body.innerHTML =
        '<div class="detail-section">' +
            '<h3>Client</h3>' +
            '<div class="detail-row"><span class="detail-label">Name</span><span class="detail-value">' + escapeHtml(data.client || 'N/A') + '</span></div>' +
            '<div class="detail-row"><span class="detail-label">Email</span><span class="detail-value">' + escapeHtml(data.email || 'N/A') + '</span></div>' +
            '<div class="detail-row"><span class="detail-label">Phone</span><span class="detail-value">' + escapeHtml(data.phone || 'N/A') + '</span></div>' +
        '</div>' +
        '<div class="detail-section">' +
            '<h3>Booking</h3>' +
            '<div class="detail-row"><span class="detail-label">Service</span><span class="detail-value">' + escapeHtml(data.service || 'N/A') + '</span></div>' +
            '<div class="detail-row"><span class="detail-label">Type</span><span class="detail-value">' + escapeHtml(data.type || 'N/A') + '</span></div>' +
            '<div class="detail-row"><span class="detail-label">Date</span><span class="detail-value">' + escapeHtml(data.date || 'N/A') + '</span></div>' +
            '<div class="detail-row"><span class="detail-label">Status</span><span class="detail-value">' + escapeHtml(data.status || 'N/A') + '</span></div>' +
            optionalRows +
        '</div>' +
        '<div class="detail-section">' +
            '<h3>Notes</h3>' +
            '<div class="detail-row"><span class="detail-value" style="text-align:left;">' + escapeHtml(data.message || 'No extra details provided.') + '</span></div>' +
        '</div>';

    document.getElementById('bookingDetailModal').style.display = 'flex';
}

function closeBookingModal() {
    var modal = document.getElementById('bookingDetailModal');
    if (modal) {
        modal.style.display = 'none';
    }
}

function escapeHtml(value) {
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.filter-tab').forEach(function (button) {
        button.addEventListener('click', function () {
            document.querySelectorAll('.filter-tab').forEach(function (item) {
                item.classList.remove('active');
            });
            button.classList.add('active');
            currentFilter = button.dataset.filter;
            currentPage = 1;
            renderBookingRows();
        });
    });

    var searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            currentPage = 1;
            renderBookingRows();
        });
    }

    document.querySelectorAll('.btn-view').forEach(function (button) {
        button.addEventListener('click', function () {
            var modelType = button.dataset.mtype;
            var modelId = button.dataset.mid;

            fetch('/bookings/' + modelType + '/' + modelId)
                .then(function (response) { return response.json(); })
                .then(function (data) { openBookingModal(data); })
                .catch(function () { alert('Unable to load booking details right now.'); });
        });
    });

    var overlay = document.getElementById('bookingDetailModal');
    if (overlay) {
        overlay.addEventListener('click', function (event) {
            if (event.target === overlay) {
                closeBookingModal();
            }
        });
    }

    if (document.getElementById('bookingTable')) {
        renderBookingRows();
    }
});
</script>
@endsection

@extends('layouts.app')

@section('title')
    Requests
@endsection

@section('css')
<style>
    .req-page {
        display: flex;
        flex-direction: column;
        gap: 24px;
        width: 100%;
        --admin-search-width: 418px;
    }

    .req-filter-shell,
    .req-table-shell {
        background: #fff;
        border: 1px solid #e4e8f0;
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(15, 35, 52, .04);
    }

    .req-filter-shell {
        padding: 8px;
        background: #eef1f7;
        border-color: #eef1f7;
        box-shadow: none;
    }

    .req-filter-row {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
    }

    .req-filter-btn {
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

    .req-filter-btn:hover {
        background: #f1f5fb;
    }

    .req-filter-btn.active {
        color: #fff;
        background: linear-gradient(90deg, #2e9eeb 0%, #3fa9f5 100%);
        box-shadow: 0 10px 24px rgba(46, 158, 235, .24);
    }

    .req-filter-count {
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

    .req-filter-btn.active .req-filter-count {
        background: rgba(255, 255, 255, .96);
        color: #2495e7;
    }

    .req-table-shell {
        overflow: hidden;
    }

    .req-table-wrap {
        overflow-x: auto;
    }

    .req-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 0;
    }

    .req-table thead th {
        padding: 15px 22px 12px;
        border-bottom: 1px solid #edf1f6;
        color: #5b6573;
        font-size: 13px;
        font-weight: 500;
        text-align: left;
    }

    .req-table tbody td {
        padding: 17px 22px;
        border-bottom: 1px solid #edf1f6;
        color: #2d313d;
        font-size: 14px;
        vertical-align: middle;
    }

    .req-table th:nth-child(3),
    .req-table th:nth-child(5),
    .req-table th:nth-child(6),
    .req-table td:nth-child(3),
    .req-table td:nth-child(5),
    .req-table td:nth-child(6) {
        white-space: nowrap;
    }

    .req-table th:last-child,
    .req-table td:last-child {
        text-align: right;
    }

    .req-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .req-table tbody tr:hover td {
        background: #fbfcff;
    }

    .req-status {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 88px;
        padding: 4px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 500;
    }

    .req-status.approved {
        color: #16a34a;
        background: #dcfce7;
    }

    .req-status.pending {
        color: #d59a08;
        background: #fff1b8;
    }

    .req-status.rejected {
        color: #ef4444;
        background: #fef3e7;
    }

    .req-view-link {
        border: 0;
        background: transparent;
        color: #1f6ca7;
        font-size: 13px;
        font-style: italic;
        font-weight: 600;
        padding: 0;
        cursor: pointer;
    }

    .req-view-link:hover {
        color: #145483;
        text-decoration: underline;
    }

    .req-table-footer {
        display: flex;
        justify-content: center;
        padding: 20px 18px 24px;
    }

    .req-pagination {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .req-page-btn {
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

    .req-page-btn.active {
        background: #d9dde5;
        color: #2d313d;
    }

    .req-page-btn.next-btn {
        background: transparent;
        color: #9aa3b2;
        width: auto;
        border-radius: 0;
    }

    .req-empty-state {
        padding: 44px 24px;
        text-align: center;
        color: #9aa3b2;
        font-size: 14px;
    }

    .req-modal-overlay {
        position: fixed;
        inset: 0;
        display: none;
        align-items: center;
        justify-content: center;
        background: rgba(15, 42, 56, .45);
        z-index: 2100;
        padding: 18px;
    }

    .req-modal {
        width: min(560px, 100%);
        max-height: 90vh;
        overflow-y: auto;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 24px 60px rgba(15, 35, 52, .22);
        padding: 22px;
    }

    .req-modal-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 16px;
    }

    .req-modal-head h2 {
        margin: 0;
        color: #183247;
        font-size: 20px;
        font-weight: 700;
    }

    .req-modal-close {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 0;
        background: #f1f5fb;
        color: #526071;
        font-size: 18px;
        cursor: pointer;
    }

    .req-detail-card {
        border: 1px solid #edf1f6;
        border-radius: 12px;
        padding: 14px 16px;
        margin-bottom: 12px;
    }

    .req-detail-card:last-child {
        margin-bottom: 0;
    }

    .req-detail-card h3 {
        margin: 0 0 10px;
        color: #183247;
        font-size: 14px;
        font-weight: 700;
    }

    .req-detail-row {
        display: flex;
        gap: 12px;
        justify-content: space-between;
        padding: 6px 0;
        border-bottom: 1px dashed #edf1f6;
        font-size: 13px;
    }

    .req-detail-row:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .req-detail-label {
        color: #6b7280;
        font-weight: 500;
    }

    .req-detail-value {
        color: #2d313d;
        font-weight: 500;
        text-align: right;
    }

    .req-modal-foot {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 18px;
    }

    .req-modal-btn {
        border: 0;
        border-radius: 8px;
        height: 40px;
        padding: 0 18px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background .18s ease, opacity .18s ease;
    }

    .req-modal-btn.secondary {
        background: #eef1f5;
        color: #556274;
    }

    .req-modal-btn.secondary:hover {
        background: #e5e9f0;
    }

    .req-modal-btn.approve {
        background: #15803d;
        color: #fff;
    }

    .req-modal-btn.approve:hover {
        background: #166534;
    }

    .req-modal-btn.reject {
        background: #e53e3e;
        color: #fff;
    }

    .req-modal-btn.reject:hover {
        background: #c53030;
    }

    .req-modal-btn[disabled] {
        opacity: .55;
        cursor: not-allowed;
    }

    @media (max-width: 991px) {
        .req-table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .req-filter-row { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }

    @media (max-width: 767px) {
        .req-filter-row {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .req-detail-row {
            flex-direction: column;
            gap: 4px;
        }

        .req-detail-value {
            text-align: left;
        }
    }
</style>
@endsection

@section('content')
    <div class="req-page">
        @include('layouts.partials.admin_topbar', [
            'title' => 'Requests',
            'searchInputId' => 'searchInput',
            'searchAriaLabel' => 'Search requests',
        ])

        <section class="req-filter-shell">
            <div class="req-filter-row">
                <button class="req-filter-btn active" data-filter="all">All <span class="req-filter-count">{{ $allCount }}</span></button>
                <button class="req-filter-btn" data-filter="pending">Pending <span class="req-filter-count">{{ $pendingCount }}</span></button>
                <button class="req-filter-btn" data-filter="approved">Approved <span class="req-filter-count">{{ $approvedCount }}</span></button>
                <button class="req-filter-btn" data-filter="rejected">Rejected <span class="req-filter-count">{{ $rejectedCount }}</span></button>
            </div>
        </section>

        <section class="req-table-shell">
            @if($allRequests->count())
            <div class="req-table-wrap">
                <table class="req-table" id="requestTable">
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
                        @foreach($allRequests as $request)
                        <tr data-status="{{ $request['status_key'] }}">
                            <td>{{ $request['service'] }}</td>
                            <td>{{ $request['type'] }}</td>
                            <td>{{ $request['formatted_date'] }}</td>
                            <td>{{ $request['client'] }}</td>
                            <td>
                                <span class="req-status {{ $request['status_key'] }}">{{ $request['status'] }}</span>
                            </td>
                            <td>
                                <button
                                    class="req-view-link btn-view"
                                    data-mtype="{{ $request['model_type'] }}"
                                    data-mid="{{ $request['model_id'] }}">
                                    View Details
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="req-table-footer">
                <div class="req-pagination" id="requestPagination"></div>
            </div>
            @else
            <div class="req-empty-state">No requests found.</div>
            @endif
        </section>
    </div>

    <div class="req-modal-overlay" id="requestModal">
        <div class="req-modal">
            <div class="req-modal-head">
                <h2>Request Details</h2>
                <button type="button" class="req-modal-close" onclick="closeRequestModal()">&times;</button>
            </div>
            <div id="requestModalBody"></div>
            <div class="req-modal-foot">
                <button type="button" class="req-modal-btn secondary" onclick="closeRequestModal()">Close</button>
                <button type="button" class="req-modal-btn reject" id="requestReject">Reject</button>
                <button type="button" class="req-modal-btn approve" id="requestApprove">Approve</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
var requestRowsPerPage = 8;
var requestCurrentPage = 1;
var requestCurrentFilter = 'all';
var activeRequestType = '';
var activeRequestId = '';

function getRequestRows() {
    return Array.from(document.querySelectorAll('#requestTable tbody tr'));
}

function escapeHtml(value) {
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function getVisibleRequestRows() {
    var query = '';
    var searchInput = document.getElementById('searchInput');

    if (searchInput) {
        query = searchInput.value.trim().toLowerCase();
    }

    return getRequestRows().filter(function (row) {
        if (requestCurrentFilter !== 'all' && row.dataset.status !== requestCurrentFilter) {
            return false;
        }

        if (query && row.textContent.toLowerCase().indexOf(query) === -1) {
            return false;
        }

        return true;
    });
}

function renderRequestTable() {
    var rows = getVisibleRequestRows();
    var pageCount = Math.max(1, Math.ceil(rows.length / requestRowsPerPage));

    if (requestCurrentPage > pageCount) {
        requestCurrentPage = 1;
    }

    getRequestRows().forEach(function (row) {
        row.style.display = 'none';
    });

    rows.slice((requestCurrentPage - 1) * requestRowsPerPage, requestCurrentPage * requestRowsPerPage).forEach(function (row) {
        row.style.display = '';
    });

    renderRequestPagination(pageCount);
}

function renderRequestPagination(pageCount) {
    var container = document.getElementById('requestPagination');
    if (!container) {
        return;
    }

    var buttons = [];
    for (var page = 1; page <= pageCount; page++) {
        buttons.push(
            '<button type="button" class="req-page-btn' + (page === requestCurrentPage ? ' active' : '') + '" onclick="goToRequestPage(' + page + ')">' + page + '</button>'
        );
    }

    if (requestCurrentPage < pageCount) {
        buttons.push('<button type="button" class="req-page-btn next-btn" onclick="goToRequestPage(' + (requestCurrentPage + 1) + ')">&gt;</button>');
    }

    container.innerHTML = buttons.join('');
}

function goToRequestPage(page) {
    requestCurrentPage = page;
    renderRequestTable();
}

function renderRequestDetails(data) {
    var optionalRows = '';

    if (data.location) {
        optionalRows += '<div class="req-detail-row"><span class="req-detail-label">Location</span><span class="req-detail-value">' + escapeHtml(data.location) + '</span></div>';
    }

    if (data.destination) {
        optionalRows += '<div class="req-detail-row"><span class="req-detail-label">Destination</span><span class="req-detail-value">' + escapeHtml(data.destination) + '</span></div>';
    }

    if (data.number_of_days) {
        optionalRows += '<div class="req-detail-row"><span class="req-detail-label">Days</span><span class="req-detail-value">' + escapeHtml(String(data.number_of_days)) + '</span></div>';
    }

    if (data.number_of_people) {
        optionalRows += '<div class="req-detail-row"><span class="req-detail-label">People</span><span class="req-detail-value">' + escapeHtml(String(data.number_of_people)) + '</span></div>';
    }

    if (data.price) {
        optionalRows += '<div class="req-detail-row"><span class="req-detail-label">Price</span><span class="req-detail-value">' + escapeHtml(String(data.price)) + '</span></div>';
    }

    return '' +
        '<div class="req-detail-card">' +
            '<h3>Client</h3>' +
            '<div class="req-detail-row"><span class="req-detail-label">Name</span><span class="req-detail-value">' + escapeHtml(data.client || 'N/A') + '</span></div>' +
            '<div class="req-detail-row"><span class="req-detail-label">Email</span><span class="req-detail-value">' + escapeHtml(data.email || 'N/A') + '</span></div>' +
            '<div class="req-detail-row"><span class="req-detail-label">Phone</span><span class="req-detail-value">' + escapeHtml(data.phone || 'N/A') + '</span></div>' +
        '</div>' +
        '<div class="req-detail-card">' +
            '<h3>Request</h3>' +
            '<div class="req-detail-row"><span class="req-detail-label">Service</span><span class="req-detail-value">' + escapeHtml(data.service || 'N/A') + '</span></div>' +
            '<div class="req-detail-row"><span class="req-detail-label">Type</span><span class="req-detail-value">' + escapeHtml(data.type || 'N/A') + '</span></div>' +
            '<div class="req-detail-row"><span class="req-detail-label">Date</span><span class="req-detail-value">' + escapeHtml(data.date || 'N/A') + '</span></div>' +
            '<div class="req-detail-row"><span class="req-detail-label">Status</span><span class="req-detail-value"><span class="req-status ' + escapeHtml(String(data.status || 'pending').toLowerCase()) + '">' + escapeHtml(data.status || 'Pending') + '</span></span></div>' +
            optionalRows +
        '</div>' +
        '<div class="req-detail-card">' +
            '<h3>Notes</h3>' +
            '<div class="req-detail-row"><span class="req-detail-value" style="text-align:left;">' + escapeHtml(data.message || 'No extra details provided.') + '</span></div>' +
        '</div>';
}

function openRequestModal(data, type, id) {
    activeRequestType = type;
    activeRequestId = id;

    document.getElementById('requestModalBody').innerHTML = renderRequestDetails(data);
    document.getElementById('requestModal').style.display = 'flex';

    var approveButton = document.getElementById('requestApprove');
    var rejectButton = document.getElementById('requestReject');
    var currentStatus = String(data.status || '').toLowerCase();

    approveButton.disabled = currentStatus === 'approved';
    rejectButton.disabled = currentStatus === 'rejected';
}

function closeRequestModal() {
    var modal = document.getElementById('requestModal');
    if (modal) {
        modal.style.display = 'none';
    }
}

function updateRequestStatus(status) {
    fetch('/requests/' + activeRequestType + '/' + activeRequestId + '/status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
        },
        body: 'status=' + encodeURIComponent(status)
    }).then(function () {
        location.reload();
    }).catch(function () {
        alert('Unable to update request status right now.');
    });
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.req-filter-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            document.querySelectorAll('.req-filter-btn').forEach(function (item) {
                item.classList.remove('active');
            });
            button.classList.add('active');
            requestCurrentFilter = button.dataset.filter;
            requestCurrentPage = 1;
            renderRequestTable();
        });
    });

    var searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            requestCurrentPage = 1;
            renderRequestTable();
        });
    }

    document.querySelectorAll('.btn-view').forEach(function (button) {
        button.addEventListener('click', function () {
            var modelType = button.dataset.mtype;
            var modelId = button.dataset.mid;

            fetch('/requests/' + modelType + '/' + modelId)
                .then(function (response) { return response.json(); })
                .then(function (data) { openRequestModal(data, modelType, modelId); })
                .catch(function () { alert('Unable to load request details right now.'); });
        });
    });

    document.getElementById('requestApprove').addEventListener('click', function () {
        updateRequestStatus('Approved');
    });

    document.getElementById('requestReject').addEventListener('click', function () {
        updateRequestStatus('Rejected');
    });

    var overlay = document.getElementById('requestModal');
    if (overlay) {
        overlay.addEventListener('click', function (event) {
            if (event.target === overlay) {
                closeRequestModal();
            }
        });
    }

    if (document.getElementById('requestTable')) {
        renderRequestTable();
    }
});
</script>
@endsection

@extends('layouts.app')
@section('title') Newsletter Subscribers @endsection

@section('css')
<style>
    .subs-page { display:flex; flex-direction:column; gap:22px; width:100%; }
    .adm-flash { padding:12px 18px; border-radius:10px; font-size:14px; margin-bottom:4px; }
    .adm-flash.success { background:#f0fdf4; border:1px solid #bbf7d0; color:#15803d; }
    .adm-flash.error   { background:#fef2f2; border:1px solid #fecaca; color:#dc2626; }

    .subs-toolbar { display:flex; align-items:center; justify-content:space-between; gap:14px; flex-wrap:wrap; }

    .subs-table-wrap { background:#fff; border-radius:14px; border:1px solid #e4e8f0; box-shadow:0 2px 12px rgba(13,31,53,.05); overflow:hidden; }
    .subs-table { width:100%; border-collapse:collapse; }
    .subs-table thead { background:#f7f8fb; }
    .subs-table th { padding:13px 18px; text-align:left; font-size:12px; font-weight:700; color:#555; text-transform:uppercase; letter-spacing:.5px; border-bottom:1px solid #eee; }
    .subs-table td { padding:13px 18px; font-size:14px; color:#333; border-bottom:1px solid #f4f4f4; vertical-align:middle; }
    .subs-table tbody tr:last-child td { border-bottom:none; }
    .subs-table tbody tr:hover td { background:#fafbfc; }

    .badge-active { display:inline-block; background:#f0fdf4; color:#15803d; border:1px solid #bbf7d0; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:600; }

    .btn-del-sub { background:#fff; color:#e74c3c; border:1px solid #e74c3c; border-radius:7px; padding:5px 12px; font-size:12px; font-weight:600; cursor:pointer; }
    .btn-del-sub:hover { background:#e74c3c; color:#fff; }

    .no-subs { text-align:center; padding:60px 20px; color:#bbb; }
    .no-subs i { font-size:40px; display:block; margin-bottom:12px; }

    /* Modal */
    .adm-modal-overlay { position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,.48); display:flex; align-items:center; justify-content:center; z-index:2000; padding:16px; }
    .adm-modal { background:#fff; border-radius:16px; padding:28px 32px; max-width:560px; width:100%; max-height:92vh; overflow-y:auto; }
    .adm-modal-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:22px; }
    .adm-modal-head h3 { font-size:18px; font-weight:700; color:#1a1a2e; margin:0; }
    .adm-modal-close { background:none; border:none; font-size:22px; cursor:pointer; color:#aaa; }
    .adm-form-group { display:flex; flex-direction:column; margin-bottom:16px; }
    .adm-form-group label { font-size:13px; font-weight:600; color:#444; margin-bottom:6px; }
    .adm-form-group input,
    .adm-form-group textarea { padding:10px 14px; border:1.5px solid #e0e0e0; border-radius:8px; font-size:14px; outline:none; font-family:inherit; background:#fff; color:#1a1a2e; }
    .adm-form-group input:focus,
    .adm-form-group textarea:focus { border-color:#0D1F35; }
    .adm-form-group textarea { resize:vertical; min-height:160px; }
    .adm-modal-foot { display:flex; justify-content:flex-end; gap:10px; border-top:1px solid #f0f0f0; padding-top:18px; margin-top:8px; }
    .btn-save { background:#C85A2A; color:#fff; border:none; padding:11px 28px; border-radius:8px; font-size:14px; font-weight:600; cursor:pointer; }
    .btn-save:hover { background:#a84820; }
    .btn-cancel { background:#f0f0f0; color:#555; border:none; padding:11px 20px; border-radius:8px; font-size:14px; font-weight:600; cursor:pointer; }

    .subscriber-count { font-size:14px; color:#666; }

    @media (max-width: 767px) {
        .subs-toolbar { flex-direction:column; align-items:flex-start; }
        .subs-table th:nth-child(3), .subs-table td:nth-child(3) { display:none; }
        .adm-modal { padding:22px 18px 28px; }
    }
</style>
@endsection

@section('content')
<div class="subs-page">

    @include('layouts.partials.admin_topbar', ['title' => 'Newsletter Subscribers', 'searchInputId' => 'subSearch', 'searchAriaLabel' => 'Search subscribers'])

    @if(session('success'))
        <div class="adm-flash success"><i class="fas fa-check-circle" style="margin-right:6px"></i>{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="adm-flash error"><i class="fas fa-exclamation-circle" style="margin-right:6px"></i>{{ session('error') }}</div>
    @endif

    <div class="subs-toolbar">
        <span class="subscriber-count">{{ $subscribers->count() }} subscriber{{ $subscribers->count() !== 1 ? 's' : '' }}</span>
        <button class="admin-primary-btn" type="button" onclick="openNewsletterModal()">
            <i class="fas fa-paper-plane"></i> Send Newsletter
        </button>
    </div>

    <div class="subs-table-wrap">
        @if($subscribers->count())
        <table class="subs-table" id="subsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Subscribed</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscribers as $i => $sub)
                <tr class="sub-row" data-searchable data-email="{{ strtolower($sub->email) }}">
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $sub->email }}</td>
                    <td>{{ $sub->name ?? '—' }}</td>
                    <td>{{ $sub->subscribed_at ? $sub->subscribed_at->format('M d, Y') : $sub->created_at->format('M d, Y') }}</td>
                    <td><span class="badge-active">Active</span></td>
                    <td>
                        <button class="btn-del-sub" onclick="deleteSub({{ $sub->id }})">Remove</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="no-subs">
            <i class="fas fa-envelope-open"></i>
            No subscribers yet. Share your site so people can subscribe!
        </div>
        @endif
    </div>

</div>

{{-- Send Newsletter Modal --}}
<div class="adm-modal-overlay" id="newsletterModal" style="display:none;">
    <div class="adm-modal">
        <div class="adm-modal-head">
            <h3><i class="fas fa-paper-plane" style="color:#C85A2A;margin-right:8px"></i>Send Newsletter</h3>
            <button class="adm-modal-close" onclick="closeNewsletterModal()">&times;</button>
        </div>
        <form action="{{ route('admin.subscribers.send') }}" method="POST">
            @csrf
            <div class="adm-form-group">
                <label>Subject <span style="color:#e74c3c">*</span></label>
                <input type="text" name="subject" placeholder="e.g. New Tours Available This Season!" required>
            </div>
            <div class="adm-form-group">
                <label>Message <span style="color:#e74c3c">*</span></label>
                <textarea name="body" placeholder="Write your newsletter message here..." required></textarea>
            </div>
            <p style="font-size:12px;color:#999;margin-bottom:16px;">
                <i class="fas fa-info-circle"></i>
                This will be sent to all <strong>{{ $subscribers->count() }}</strong> active subscriber(s).
            </p>
            <div class="adm-modal-foot">
                <button type="button" class="btn-cancel" onclick="closeNewsletterModal()">Cancel</button>
                <button type="submit" class="btn-save">
                    <i class="fas fa-paper-plane" style="margin-right:6px"></i>Send to All
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openNewsletterModal()  { document.getElementById('newsletterModal').style.display = 'flex'; }
function closeNewsletterModal() { document.getElementById('newsletterModal').style.display = 'none'; }

function deleteSub(id) {
    if (!confirm('Remove this subscriber?')) return;
    var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '/admin/subscribers/' + id;
    [['_token', csrf], ['_method', 'DELETE']].forEach(function(p) {
        var inp = document.createElement('input');
        inp.type = 'hidden'; inp.name = p[0]; inp.value = p[1];
        form.appendChild(inp);
    });
    document.body.appendChild(form);
    form.submit();
}

document.addEventListener('DOMContentLoaded', function () {
    var search = document.getElementById('subSearch');
    if (search) {
        search.addEventListener('input', function () {
            var q = search.value.trim().toLowerCase();
            document.querySelectorAll('.sub-row').forEach(function (row) {
                row.style.display = row.dataset.email.includes(q) || row.textContent.toLowerCase().includes(q) ? '' : 'none';
            });
        });
    }
});
</script>
@endsection

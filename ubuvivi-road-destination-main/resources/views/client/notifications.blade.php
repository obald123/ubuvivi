@extends('layouts.client')

@section('title')
    Notifications
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

    /* Tabs */
    .notif-tabs { display:flex; align-items:center; gap:0; margin-bottom:0; border-bottom:1px solid #e8e8e8; }
    .ntab { padding:10px 20px; font-size:14px; font-weight:500; color:#888; cursor:pointer; border:none; background:none; border-bottom:2px solid transparent; margin-bottom:-1px; transition:color .2s; }
    .ntab.active { color:#2563EB; border-bottom-color:#2563EB; font-weight:600; }
    .ntab:hover:not(.active) { color:#555; }

    /* Notification list */
    .notif-list { background:#fff; border-radius:16px; box-shadow:0 1px 8px rgba(0,0,0,.06); overflow:hidden; margin-top:16px; }
    .notif-item {
        display:flex; align-items:center; gap:16px;
        padding:16px 24px; border-bottom:1px solid #f5f5f5;
        cursor:pointer; transition:background .15s;
        position:relative;
    }
    .notif-item:last-child { border-bottom:none; }
    .notif-item:first-child { background:#f7f8fa; }
    .notif-item:hover { background:#f7f8fa; }
    .notif-icon {
        width:42px; height:42px; border-radius:50%;
        display:flex; align-items:center; justify-content:center;
        font-size:16px; flex-shrink:0;
    }
    .ni-green  { background:#E8F8F0; color:#27AE60; }
    .ni-yellow { background:#FFF8E6; color:#F0A500; }
    .ni-purple { background:#F3EEFF; color:#7B5EE8; }
    .ni-blue   { background:#EEF2FF; color:#4F6CDE; }
    .notif-body { flex:1; min-width:0; }
    .notif-title { font-size:14px; font-weight:700; color:#1a1a2e; margin-bottom:3px; }
    .notif-desc  { font-size:13px; color:#888; line-height:1.4; }
    .notif-dot {
        width:8px; height:8px; border-radius:50%;
        background:#1a1a2e; flex-shrink:0;
    }
    .notif-dot.read { background:transparent; }

    /* Pagination */
    .cd-pagination { display:flex; align-items:center; justify-content:center; gap:6px; margin-top:20px; }
    .pg-btn { width:34px; height:34px; border-radius:8px; display:inline-flex; align-items:center; justify-content:center; font-size:13px; font-weight:600; cursor:pointer; border:1px solid #e8e8e8; background:#fff; color:#555; transition:background .2s,color .2s; }
    .pg-btn:hover { background:#f5f5f5; }
    .pg-btn.active { background:#2563EB; color:#fff; border-color:#2563EB; }
</style>
@endsection

@section('content')

    {{-- Topbar --}}
    <div class="cd-topbar">
        <div class="cd-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search...">
        </div>
        <a href="{{ route('client.new_booking') }}" class="cd-new-btn">
            <i class="fas fa-plus"></i> New Booking
        </a>
    </div>

    {{-- Tabs --}}
    <div class="notif-tabs">
        <button class="ntab active" onclick="switchTab('all',this)">All</button>
        <button class="ntab" onclick="switchTab('today',this)">Today</button>
        <button class="ntab" onclick="switchTab('history',this)">History</button>
    </div>

    {{-- Notification list --}}
    @php
    $notifications = [
        ['icon'=>'ni-green',  'fa'=>'fa-check-circle', 'title'=>'Booking Request Accepted',
         'desc'=>'A booking request for the apartment has been accepted.', 'unread'=>true,  'tag'=>'all'],
        ['icon'=>'ni-green',  'fa'=>'fa-check-circle', 'title'=>'Booking Request Accepted',
         'desc'=>'A booking request for the apartment has been accepted.', 'unread'=>true,  'tag'=>'all'],
        ['icon'=>'ni-yellow', 'fa'=>'fa-dollar-sign',  'title'=>'Payment Confirmation',
         'desc'=>'A payment of $500 has been confirmed.',                 'unread'=>true,  'tag'=>'today'],
        ['icon'=>'ni-purple', 'fa'=>'fa-cog',          'title'=>'System Update',
         'desc'=>'System maintenance will occur on Sunday, July 21st, from 10 PM to 2 AM.', 'unread'=>false, 'tag'=>'history'],
        ['icon'=>'ni-green',  'fa'=>'fa-check-circle', 'title'=>'Booking Request Accepted',
         'desc'=>'A booking request for the apartment has been accepted.', 'unread'=>false, 'tag'=>'all'],
        ['icon'=>'ni-green',  'fa'=>'fa-check-circle', 'title'=>'Booking Request Accepted',
         'desc'=>'A booking request for the apartment has been accepted.', 'unread'=>false, 'tag'=>'all'],
        ['icon'=>'ni-yellow', 'fa'=>'fa-dollar-sign',  'title'=>'Payment Confirmation',
         'desc'=>'A payment of $500 has been confirmed.',                 'unread'=>false, 'tag'=>'today'],
        ['icon'=>'ni-purple', 'fa'=>'fa-cog',          'title'=>'System Update',
         'desc'=>'System maintenance will occur on Sunday, July 21st, from 10 PM to 2 AM.', 'unread'=>false, 'tag'=>'history'],
        ['icon'=>'ni-purple', 'fa'=>'fa-cog',          'title'=>'System Update',
         'desc'=>'System maintenance will occur on Sunday, July 21st, from 10 PM to 2 AM.', 'unread'=>false, 'tag'=>'history'],
    ];
    @endphp

    <div class="notif-list" id="notifList">
        @foreach($notifications as $n)
        <div class="notif-item" data-tag="{{ $n['tag'] }}">
            <div class="notif-icon {{ $n['icon'] }}">
                <i class="fas {{ $n['fa'] }}"></i>
            </div>
            <div class="notif-body">
                <div class="notif-title">{{ $n['title'] }}</div>
                <div class="notif-desc">{{ $n['desc'] }}</div>
            </div>
            <div class="notif-dot {{ $n['unread'] ? '' : 'read' }}"></div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="cd-pagination">
        <a class="pg-btn active">1</a>
        <a class="pg-btn">2</a>
        <a class="pg-btn">3</a>
        <a class="pg-btn" style="font-size:16px;">&#8250;</a>
    </div>

@endsection

@section('scripts')
<script>
function switchTab(tag, el) {
    document.querySelectorAll('.ntab').forEach(function(t){ t.classList.remove('active'); });
    el.classList.add('active');
    document.querySelectorAll('.notif-item').forEach(function(item) {
        if (tag === 'all' || item.dataset.tag === tag) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>
@endsection

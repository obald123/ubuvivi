@extends('layouts.client')

@section('title')
    New Booking
@endsection

@section('css')
<style>
    .cd-topbar { display:flex; align-items:center; justify-content:space-between; margin-bottom:30px; gap:14px; flex-wrap:wrap; }
    .cd-search { display:flex; align-items:center; gap:10px; background:#fff; border:1px solid #e4e4e8; border-radius:10px; padding:10px 18px; flex:1; max-width:480px; }
    .cd-search i { color:#bbb; font-size:14px; }
    .cd-search input { border:none; outline:none; background:transparent; font-size:14px; color:#333; width:100%; }
    .cd-search input::placeholder { color:#bbb; }
    .cd-new-btn { background:#0D1F35; color:#fff; border:none; border-radius:50px; padding:10px 22px; font-size:14px; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:7px; white-space:nowrap; text-decoration:none; transition:background .2s; }
    .cd-new-btn:hover { background:#1e3a5f; color:#fff; text-decoration:none; }

    /* Form */
    .nb-heading { font-size:26px; font-weight:800; color:#1a1a2e; margin-bottom:28px; }
    .nb-form { max-width:860px; }
    .nb-row { display:grid; gap:20px; margin-bottom:20px; }
    .nb-row.cols-2 { grid-template-columns:1fr 1fr; }
    .nb-row.cols-1 { grid-template-columns:1fr; }
    .nb-group label {
        display:block; font-size:13px; font-weight:600;
        color:#1a1a2e; margin-bottom:8px;
    }
    .nb-group select,
    .nb-group input[type="text"],
    .nb-group input[type="number"],
    .nb-group textarea {
        width:100%; padding:12px 14px;
        border:1px solid #e0e0e0; border-radius:8px;
        font-size:14px; color:#333; background:#fff;
        outline:none; transition:border-color .2s;
        font-family:inherit;
    }
    .nb-group select:focus,
    .nb-group input:focus,
    .nb-group textarea:focus { border-color:#2563EB; }
    .nb-group select { appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23999' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 14px center; padding-right:38px; cursor:pointer; }
    .nb-group textarea { resize:vertical; min-height:140px; }

    /* Date-time group */
    .datetime-group { display:flex; gap:8px; align-items:center; }
    .datetime-group input[type="date"] { flex:1; }
    .time-input { display:flex; align-items:center; gap:4px; background:#fff; border:1px solid #e0e0e0; border-radius:8px; padding:0 10px; height:46px; }
    .time-input input { border:none; outline:none; width:60px; font-size:14px; color:#333; text-align:center; }
    .time-input select { border:none; outline:none; font-size:13px; color:#555; background:transparent; cursor:pointer; }

    /* Submit button */
    .nb-submit-wrap { text-align:center; margin-top:32px; }
    .nb-submit {
        background:#0D1F35; color:#fff; border:none;
        border-radius:50px; padding:14px 56px;
        font-size:15px; font-weight:700; cursor:pointer;
        transition:background .2s; letter-spacing:.3px;
    }
    .nb-submit:hover { background:#1e3a5f; }

    @media(max-width:640px) {
        .nb-row.cols-2 { grid-template-columns:1fr; }
        .datetime-group { flex-wrap:wrap; }
    }
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

    <h1 class="nb-heading">New Booking</h1>

    <form class="nb-form" method="POST" action="{{ url('/tours') }}" id="nbForm">
        @csrf

        {{-- Service & Type --}}
        <div class="nb-row cols-2">
            <div class="nb-group">
                <label for="service">Service</label>
                <select id="service" name="service" onchange="loadTypes(this.value)">
                    <option value="tour">Tour & Travel</option>
                    <option value="car">Car Rental</option>
                    <option value="transfer">Transfers</option>
                </select>
            </div>
            <div class="nb-group">
                <label for="type">Type</label>
                <select id="type" name="type_id">
                    @foreach($tours as $t)
                        <option value="{{ $t->id }}">{{ $t->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Number of people --}}
        <div class="nb-row cols-1">
            <div class="nb-group">
                <label for="people">Number of people</label>
                <input type="number" id="people" name="people" min="1" placeholder="">
            </div>
        </div>

        {{-- Start Date & Available until --}}
        <div class="nb-row cols-2">
            <div class="nb-group">
                <label>Start Date &amp; Time</label>
                <div class="datetime-group">
                    <input type="date" name="start_date" id="startDate">
                    <div class="time-input">
                        <input type="text" name="start_time" placeholder="00 : 00" id="startTime" maxlength="5">
                        <select name="start_ampm">
                            <option>AM</option><option>PM</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="nb-group">
                <label>Available until</label>
                <div class="datetime-group">
                    <input type="date" name="end_date" id="endDate">
                    <div class="time-input">
                        <input type="text" name="end_time" placeholder="00 : 00" id="endTime" maxlength="5">
                        <select name="end_ampm">
                            <option>AM</option><option>PM</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Special Requests --}}
        <div class="nb-row cols-1">
            <div class="nb-group">
                <label for="requests">Special Requests</label>
                <textarea id="requests" name="special_requests" placeholder=""></textarea>
            </div>
        </div>

        {{-- Submit --}}
        <div class="nb-submit-wrap">
            <button type="submit" class="nb-submit">Submit Request</button>
        </div>
    </form>

@endsection

@section('scripts')
<script>
var tourOptions     = @json($tours->map(fn($t) => ['id' => $t->id, 'name' => $t->title]));
var vehicleOptions  = @json($vehicles);
var transferOptions = [
    {id:'airport', name:'Airport Transfer'},
    {id:'hotel',   name:'Hotel Transfer'},
    {id:'city',    name:'City Transfer'},
];

function loadTypes(service) {
    var sel  = document.getElementById('type');
    var opts = service === 'tour' ? tourOptions
             : service === 'car'  ? vehicleOptions
             : transferOptions;
    sel.innerHTML = '';
    opts.forEach(function(o) {
        var op  = document.createElement('option');
        op.value = o.id;
        op.text  = o.name || '—';
        sel.appendChild(op);
    });
}

// Route form to appropriate page on submit
document.getElementById('nbForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var service = document.getElementById('service').value;
    var typeId  = document.getElementById('type').value;
    if (service === 'tour') {
        window.location.href = '/tour/' + typeId;
    } else if (service === 'car') {
        window.location.href = '/car/' + typeId;
    } else {
        window.location.href = '{{ route("guest.transfer") }}';
    }
});
</script>
@endsection

@php
    $searchInputId = $searchInputId ?? null;
    $searchPlaceholder = $searchPlaceholder ?? 'Search...';
    $searchAriaLabel = $searchAriaLabel ?? $searchPlaceholder;
    $showSearch = $showSearch ?? true;
@endphp

<style>
/* ── Notification Bell ── */
.notif-wrap {
    position: relative;
}

.notif-count {
    position: absolute;
    top: 4px; right: 4px;
    min-width: 17px; height: 17px;
    background: #ef4444;
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    border-radius: 50%;
    display: none;
    align-items: center;
    justify-content: center;
    line-height: 1;
    padding: 0 3px;
    border: 2px solid #f6f7fb;
    pointer-events: none;
}

.notif-dropdown {
    position: absolute;
    top: calc(100% + 10px);
    right: 0;
    width: 340px;
    max-width: calc(100vw - 24px);
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 8px 40px rgba(13,31,53,.18);
    z-index: 3000;
    overflow: hidden;
    display: none;
    flex-direction: column;
    border: 1px solid #e8ecf2;
}

.notif-dropdown.open { display: flex; }

.notif-dd-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 16px 10px;
    border-bottom: 1px solid #f0f2f7;
    font-weight: 700;
    font-size: 14px;
    color: #182b39;
}

.notif-read-all-btn {
    background: none;
    border: none;
    font-size: 12px;
    color: #0f5f86;
    cursor: pointer;
    font-weight: 600;
    padding: 0;
}
.notif-read-all-btn:hover { text-decoration: underline; }

.notif-dd-list {
    overflow-y: auto;
    max-height: 360px;
}

.notif-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 16px;
    border-bottom: 1px solid #f7f8fb;
    text-decoration: none;
    cursor: pointer;
    transition: background .15s;
    background: #fff;
}
.notif-item:last-child { border-bottom: none; }
.notif-item:hover { background: #f7f9ff; }
.notif-item.unread { background: #f0f6ff; }
.notif-item.unread:hover { background: #e8f0ff; }

.notif-icon-wrap {
    width: 34px; height: 34px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    font-size: 14px;
}
.notif-icon-wrap.flight_booking   { background:#e8f0fe; color:#4a73e8; }
.notif-icon-wrap.hotel_booking    { background:#e8f5e9; color:#2e7d32; }
.notif-icon-wrap.tour_booking     { background:#fff0e8; color:#C85A2A; }
.notif-icon-wrap.car_booking      { background:#f3e8ff; color:#7c3aed; }
.notif-icon-wrap.transfer_booking { background:#fef9e8; color:#d97706; }
.notif-icon-wrap.event_booking    { background:#fce4e4; color:#c62828; }
.notif-icon-wrap.contact          { background:#e8fef0; color:#059669; }

.notif-item-body { flex: 1; min-width: 0; }
.notif-item-msg {
    font-size: 13px;
    color: #182b39;
    line-height: 1.4;
    margin-bottom: 3px;
    white-space: normal;
}
.notif-item-ago { font-size: 11px; color: #9ca3af; }
.notif-unread-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: #4a73e8;
    flex-shrink: 0;
    margin-top: 5px;
}

.notif-empty {
    padding: 36px 16px;
    text-align: center;
    color: #bbb;
    font-size: 13px;
}
.notif-empty i { font-size: 28px; display: block; margin-bottom: 10px; }

.notif-loading { padding: 24px; text-align: center; color: #aaa; font-size: 13px; }
</style>

<div class="admin-page-header">
    <h1 class="admin-page-title">{{ $title }}</h1>
    <div class="admin-page-tools">
        @if($showSearch)
            <label class="admin-page-search mb-0">
                <i class="fas fa-search"></i>
                <input
                    type="text"
                    @if($searchInputId) id="{{ $searchInputId }}" @endif
                    placeholder="{{ $searchPlaceholder }}"
                    aria-label="{{ $searchAriaLabel }}">
            </label>
        @endif

        {{-- ── Notification Bell ── --}}
        <div class="notif-wrap" id="notifWrap">
            <button type="button" class="admin-page-icon" id="notifBtn" aria-label="Notifications">
                <i class="far fa-bell"></i>
                <span class="notif-count" id="notifCount"></span>
            </button>
            <div class="notif-dropdown" id="notifDropdown">
                <div class="notif-dd-head">
                    <span>Notifications</span>
                    <button class="notif-read-all-btn" id="notifReadAll">Mark all read</button>
                </div>
                <div class="notif-dd-list" id="notifList">
                    <div class="notif-loading"><i class="fas fa-circle-notch fa-spin"></i></div>
                </div>
            </div>
        </div>

        <div class="admin-page-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
    </div>
</div>

<script>
(function () {
    var csrf  = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var btn   = document.getElementById('notifBtn');
    var dd    = document.getElementById('notifDropdown');
    var list  = document.getElementById('notifList');
    var badge = document.getElementById('notifCount');
    var readAllBtn = document.getElementById('notifReadAll');
    var loaded = false;

    var iconMap = {
        flight_booking:   'fa-plane',
        hotel_booking:    'fa-hotel',
        tour_booking:     'fa-map-marked-alt',
        car_booking:      'fa-car',
        transfer_booking: 'fa-shuttle-van',
        event_booking:    'fa-calendar-alt',
        contact:          'fa-envelope',
    };

    function fetchNotifs() {
        fetch('/admin/notifications', { headers: { 'X-CSRF-TOKEN': csrf } })
            .then(function(r){ return r.json(); })
            .then(function(data) {
                renderBadge(data.unread);
                renderList(data.notifications);
                loaded = true;
            })
            .catch(function() {
                list.innerHTML = '<div class="notif-empty"><i class="fas fa-exclamation-circle"></i>Could not load notifications.</div>';
            });
    }

    function renderBadge(count) {
        if (count > 0) {
            badge.textContent = count > 99 ? '99+' : count;
            badge.style.display = 'flex';
        } else {
            badge.style.display = 'none';
        }
    }

    function renderList(items) {
        if (!items || items.length === 0) {
            list.innerHTML = '<div class="notif-empty"><i class="fas fa-bell-slash"></i>No notifications yet.</div>';
            return;
        }
        var html = '';
        items.forEach(function(n) {
            var icon = iconMap[n.type] || 'fa-bell';
            var href = n.link || '#';
            var unreadClass = n.read ? '' : ' unread';
            var dot = n.read ? '' : '<span class="notif-unread-dot"></span>';
            html += '<div class="notif-item' + unreadClass + '" data-id="' + n.id + '" data-href="' + href + '">' +
                '<div class="notif-icon-wrap ' + n.type + '"><i class="fas ' + icon + '"></i></div>' +
                '<div class="notif-item-body">' +
                '<div class="notif-item-msg">' + n.message + '</div>' +
                '<div class="notif-item-ago">' + n.ago + '</div>' +
                '</div>' + dot + '</div>';
        });
        list.innerHTML = html;

        list.querySelectorAll('.notif-item').forEach(function(el) {
            el.addEventListener('click', function() {
                var id   = el.getAttribute('data-id');
                var href = el.getAttribute('data-href');
                if (!el.classList.contains('unread')) {
                    if (href && href !== '#') window.location.href = href;
                    return;
                }
                fetch('/admin/notifications/' + id + '/read', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' }
                }).then(function() {
                    el.classList.remove('unread');
                    el.querySelector('.notif-unread-dot') && el.querySelector('.notif-unread-dot').remove();
                    var cur = parseInt(badge.textContent) || 0;
                    renderBadge(Math.max(0, cur - 1));
                    if (href && href !== '#') window.location.href = href;
                });
            });
        });
    }

    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        var open = dd.classList.toggle('open');
        if (open && !loaded) fetchNotifs();
    });

    readAllBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        fetch('/admin/notifications/read-all', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' }
        }).then(function() {
            list.querySelectorAll('.notif-item.unread').forEach(function(el) {
                el.classList.remove('unread');
                var dot = el.querySelector('.notif-unread-dot');
                if (dot) dot.remove();
            });
            renderBadge(0);
        });
    });

    document.addEventListener('click', function(e) {
        if (!document.getElementById('notifWrap').contains(e.target)) {
            dd.classList.remove('open');
        }
    });

    /* Poll unread count every 60 seconds to keep badge fresh */
    fetchNotifs();
    setInterval(function() {
        fetch('/admin/notifications', { headers: { 'X-CSRF-TOKEN': csrf } })
            .then(function(r){ return r.json(); })
            .then(function(d){ renderBadge(d.unread); })
            .catch(function(){});
    }, 60000);
})();
</script>

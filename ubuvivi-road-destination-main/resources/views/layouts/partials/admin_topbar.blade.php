@php
    $searchInputId = $searchInputId ?? null;
    $searchPlaceholder = $searchPlaceholder ?? 'Search...';
    $searchAriaLabel = $searchAriaLabel ?? $searchPlaceholder;
    $showSearch = $showSearch ?? true;
@endphp

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
        <button type="button" class="admin-page-icon" aria-label="Notifications">
            <i class="far fa-bell"></i>
            <span class="admin-page-dot"></span>
        </button>
        <div class="admin-page-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
    </div>
</div>

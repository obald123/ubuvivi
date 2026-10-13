@extends('layouts.app')

@section('title')
    Admin Activity
@endsection

@section('content')
    <div class="services-page">
        @include('layouts.partials.admin_topbar', [
            'title' => 'Admin Activity',
            'searchInputId' => 'activitySearch',
            'searchPlaceholder' => 'Search activity...',
            'searchAriaLabel' => 'Search admin activity',
            'showSearch' => false,
        ])

        <form method="GET" action="{{ route('admin.activity.index') }}" class="row mb-3">
            <div class="col-md-5 mb-2">
                <input
                    id="activitySearch"
                    type="search"
                    name="search"
                    value="{{ $validated['search'] ?? '' }}"
                    class="form-control"
                    placeholder="Search actor, action, or target">
            </div>
            <div class="col-md-3 mb-2">
                <input type="date" name="from" value="{{ $validated['from'] ?? '' }}" class="form-control" aria-label="From date">
            </div>
            <div class="col-md-3 mb-2">
                <input type="date" name="to" value="{{ $validated['to'] ?? '' }}" class="form-control" aria-label="To date">
            </div>
            <div class="col-md-1 mb-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>

        <div class="table-responsive bg-white rounded shadow-sm">
            <table class="table table-hover mb-0">
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
                            <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                <strong>{{ $log->actor_name }}</strong><br>
                                <small>{{ $log->actor_email }}</small>
                            </td>
                            <td>{{ $log->action }}</td>
                            <td>{{ $log->target }}</td>
                            <td>
                                <details>
                                    <summary>View details</summary>
                                    <pre class="mb-0 mt-2" style="white-space:pre-wrap;max-width:420px;">{{ json_encode($log->details, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                </details>
                            </td>
                            <td>{{ $log->ip_address }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No admin activity recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $logs->links() }}</div>
    </div>
@endsection

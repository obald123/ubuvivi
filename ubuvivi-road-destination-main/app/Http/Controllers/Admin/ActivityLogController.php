<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:100',
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
        ]);

        $logs = AdminActivityLog::query()
            ->when($validated['search'] ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('actor_name', 'like', '%' . $search . '%')
                        ->orWhere('actor_email', 'like', '%' . $search . '%')
                        ->orWhere('action', 'like', '%' . $search . '%')
                        ->orWhere('target', 'like', '%' . $search . '%');
                });
            })
            ->when($validated['from'] ?? null, function ($query, $from) {
                $query->whereDate('created_at', '>=', $from);
            })
            ->when($validated['to'] ?? null, function ($query, $to) {
                $query->whereDate('created_at', '<=', $to);
            })
            ->latest('created_at')
            ->paginate(25)
            ->withQueryString();

        return view('admin.activity.index', compact('logs', 'validated'));
    }
}

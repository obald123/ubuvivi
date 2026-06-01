<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = AdminNotification::latest()->take(25)->get()->map(function ($n) {
            return [
                'id'      => $n->id,
                'type'    => $n->type,
                'message' => $n->message,
                'link'    => $n->link,
                'read'    => !is_null($n->read_at),
                'ago'     => $n->created_at->locale('en')->diffForHumans(),
            ];
        });

        return response()->json([
            'notifications' => $notifications,
            'unread'        => AdminNotification::whereNull('read_at')->count(),
        ]);
    }

    public function markRead($id)
    {
        AdminNotification::whereNull('read_at')->where('id', $id)->update(['read_at' => now()]);
        return response()->json(['success' => true]);
    }

    public function markAllRead()
    {
        AdminNotification::whereNull('read_at')->update(['read_at' => now()]);
        return response()->json(['success' => true]);
    }
}

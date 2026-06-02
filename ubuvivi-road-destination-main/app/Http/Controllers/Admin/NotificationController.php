<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;

class NotificationController extends Controller
{
    public function index()
    {
        try {
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

            $unread = AdminNotification::whereNull('read_at')->count();
        } catch (\Exception $e) {
            \Log::error('Notification fetch failed: ' . $e->getMessage());
            return response()->json(['notifications' => [], 'unread' => 0]);
        }

        return response()->json([
            'notifications' => $notifications,
            'unread'        => $unread,
        ]);
    }

    public function markRead($id)
    {
        try {
            AdminNotification::whereNull('read_at')->where('id', $id)->update(['read_at' => now()]);
        } catch (\Exception $e) {
            \Log::error('markRead failed: ' . $e->getMessage());
        }
        return response()->json(['success' => true]);
    }

    public function markAllRead()
    {
        try {
            AdminNotification::whereNull('read_at')->update(['read_at' => now()]);
        } catch (\Exception $e) {
            \Log::error('markAllRead failed: ' . $e->getMessage());
        }
        return response()->json(['success' => true]);
    }
}

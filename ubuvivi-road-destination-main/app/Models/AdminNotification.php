<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    protected $fillable = ['type', 'message', 'link', 'read_at'];

    protected $casts = ['read_at' => 'datetime'];

    public static function notify(string $type, string $message, ?string $link = null): void
    {
        static::create(compact('type', 'message', 'link'));
    }

    public static function unreadCount(): int
    {
        return static::whereNull('read_at')->count();
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClientMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        if (isset($user->role) && in_array($user->role, ['client', 'staff'])) {
            return $next($request);
        }

        if (isset($user->role) && $user->role === 'admin') {
            return redirect()->route('home');
        }

        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\AdminActivityLog;
use Closure;
use Illuminate\Http\Request;

class AuditAdminActivity
{
    private const SENSITIVE_KEYS = [
        'password',
        'password_confirmation',
        'current_password',
        'new_password',
        'token',
        'secret',
        'authorization',
        'credit_card',
        'card_number',
        'cvv',
    ];

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $user = $request->user();

        if (
            !$user ||
            !$user->isAdmin() ||
            in_array($request->method(), ['GET', 'HEAD', 'OPTIONS'], true) ||
            $response->getStatusCode() >= 400 ||
            $request->session()->has('errors') ||
            $request->session()->has('error')
        ) {
            return $response;
        }

        $route = $request->route();
        $action = $route ? ($route->getName() ?: $route->getActionName()) : $request->path();
        $parameters = $route ? $route->parameters() : [];

        AdminActivityLog::create([
            'user_id' => $user->id,
            'actor_name' => $user->name,
            'actor_email' => $user->email,
            'action' => strtoupper($request->method()) . ' ' . $action,
            'target' => $request->path(),
            'details' => $this->sanitize([
                'route_parameters' => $parameters,
                'input' => $request->except(['_token', '_method']),
                'response_status' => $response->getStatusCode(),
            ]),
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 2000),
            'created_at' => now(),
        ]);

        return $response;
    }

    private function sanitize(array $values): array
    {
        $sanitized = [];

        foreach ($values as $key => $value) {
            if ($this->isSensitiveKey((string) $key) || is_object($value)) {
                continue;
            }

            if (is_array($value)) {
                $sanitized[$key] = $this->sanitize($value);
            } elseif (is_string($value)) {
                $sanitized[$key] = substr($value, 0, 2000);
            } elseif (is_scalar($value) || $value === null) {
                $sanitized[$key] = $value;
            }
        }

        return $sanitized;
    }

    private function isSensitiveKey(string $key): bool
    {
        $key = strtolower($key);

        foreach (self::SENSITIVE_KEYS as $sensitiveKey) {
            if ($key === $sensitiveKey || strpos($key, $sensitiveKey) !== false) {
                return true;
            }
        }

        return false;
    }
}

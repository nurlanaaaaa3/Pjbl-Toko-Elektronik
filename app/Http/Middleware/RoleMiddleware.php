<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            // Kalau akses route admin, redirect ke login admin
            if (str_starts_with($request->path(), 'admin')) {
                return redirect()->route('admin.login');
            }
            return redirect()->route('login');
        }

        $user = auth()->user();

        if ($user->role !== $role) {
            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            }
            return redirect()->route('shop.index');
        }

        return $next($request);
    }
}
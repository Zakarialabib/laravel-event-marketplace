<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthRole
{
    /**
     * Handle an incoming request.
     *
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = auth()->user();

        if ($user instanceof \Illuminate\Contracts\Auth\Authenticatable) {
            if ($role === $user->hasRole('admin')) {
                return $next($request);
            }

            if ($role === $user->hasRole('client')) {
                return $next($request);
            }
        }

        abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
    }
}

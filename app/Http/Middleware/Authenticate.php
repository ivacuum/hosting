<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->guest()) {
            return $next($request);
        }

        if ($request->ajax()) {
            return response('Unauthorized.', 401);
        }

        return redirect()->guest('auth/login')
            ->with('message', 'Для просмотра этой страницы необходимо войти на сайт');
    }
}

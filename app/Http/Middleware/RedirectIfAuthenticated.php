<?php namespace App\Http\Middleware;

class RedirectIfAuthenticated
{
    public function handle($request, \Closure $next, $guard = null)
    {
        if (\Auth::guard($guard)->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}

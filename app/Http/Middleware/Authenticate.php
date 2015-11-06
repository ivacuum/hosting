<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        if (!$this->auth->guest()) {
            return $next($request);
        }

        if ($request->ajax()) {
            return response('Unauthorized.', 401);
        }

        return redirect()->guest('auth/login')
            ->with('message', 'Для просмотра этой страницы необходимо войти на сайт');
    }
}

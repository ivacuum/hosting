<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Admin
{
    public function __construct(protected Guard $auth)
    {
    }

    public function handle($request, Closure $next)
    {
        if (!$this->auth->check() || !$this->auth->user()->isAdmin()) {
            abort(401);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

class Breadcrumbs
{
    public function handle($request, \Closure $next, $trans, $slug = null)
    {
        if ($request->isMethod('GET')) {
            \Breadcrumbs::push(__($trans), $slug);
        }

        return $next($request);
    }
}

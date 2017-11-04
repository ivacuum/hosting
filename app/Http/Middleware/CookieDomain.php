<?php namespace App\Http\Middleware;

class CookieDomain
{
    public function handle($request, \Closure $next)
    {
        /* @var \Illuminate\Http\Request $request */
        $host = $request->getHttpHost();

        if (in_array($host, ['ivacuum.ru', 'vacuum.name'])) {
            config(['session.domain' => ".{$host}"]);
        }

        return $next($request);
    }
}

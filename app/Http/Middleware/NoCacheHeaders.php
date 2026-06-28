<?php

namespace App\Http\Middleware;

class NoCacheHeaders
{
    public function handle($request, \Closure $next)
    {
        if (app()->runningUnitTests()) {
            return $next($request);
        }

        /** @var \Illuminate\Http\Response $response */
        $response = $next($request);

        if (method_exists($response, 'header')) {
            $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        }

        return $response;
    }
}

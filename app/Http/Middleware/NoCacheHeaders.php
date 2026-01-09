<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Foundation\Application;

class NoCacheHeaders
{
    public function __construct(private Application $app) {}

    public function handle($request, \Closure $next)
    {
        if ($this->app->runningUnitTests()) {
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

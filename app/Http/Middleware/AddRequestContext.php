<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddRequestContext
{
    public function handle(Request $request, \Closure $next): Response
    {
        $requestId = $request->header('X-Request-ID');

        if (is_string($requestId) && $requestId !== '') {
            \Context::add('request_id', $requestId);
        }

        return $next($request);
    }
}

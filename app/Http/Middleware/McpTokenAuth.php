<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class McpTokenAuth
{
    public function handle(Request $request, \Closure $next): Response
    {
        $expected = config('cfg.mcp_token');

        if (blank($expected)) {
            return response('MCP server is not configured.', 503);
        }

        $token = $request->bearerToken();

        if ($token === null || !hash_equals($expected, $token)) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}

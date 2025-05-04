<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class EarlyHints
{
    public function handle(Request $request, \Closure $next)
    {
        if (!$request->isMethodCacheable()) {
            return $next($request);
        }

        $response = $next($request);

        $manifest = json_decode(file_get_contents(public_path('assets/manifest.json')), associative: true);

        $links = [
            "</assets/{$manifest['resources/css/app.css']['file']}>; rel=preload; as=style",
            "</assets/{$manifest['resources/js/app.js']['file']}>; rel=preload; as=script",
            "</assets/{$manifest['resources/css/InterVariable.woff2']['file']}>; rel=preload; as=font",
            "</assets/{$manifest['resources/css/InterVariable-Italic.woff2']['file']}>; rel=preload; as=font",
        ];

        $response->headers->set('Link', implode(', ', $links));

        return $response;
    }
}

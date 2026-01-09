<?php

namespace App\Http\Middleware;

use App\Events\Stats\SpammerTrapped;
use App\Events\Stats\SpammerTrappedHttp1;
use Illuminate\Validation\ValidationException;

class SpammerTrap
{
    public function handle($request, \Closure $next)
    {
        /** @var \Illuminate\Http\Request $request */
        $method = $request->method();

        if (!in_array($method, ['POST', 'PUT'])) {
            return $next($request);
        }

        if ($method === 'POST' && $request->getProtocolVersion() === 'HTTP/1.0') {
            event(new SpammerTrappedHttp1);

            throw ValidationException::withMessages([
                'mail' => [__('auth.spammer_trapped')],
            ]);
        }

        if (!$request->filled('mail')) {
            return $next($request);
        }

        event(new SpammerTrapped);

        throw ValidationException::withMessages([
            'mail' => [__('auth.spammer_trapped')],
        ]);
    }
}

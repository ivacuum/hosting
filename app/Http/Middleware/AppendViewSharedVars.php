<?php

namespace App\Http\Middleware;

use App\Domain\Blade\Action\AppendViewSharedVarsAction;
use Illuminate\Http\Request;

class AppendViewSharedVars
{
    public function __construct(private AppendViewSharedVarsAction $appendViewSharedVars) {}

    public function handle(Request $request, \Closure $next)
    {
        if (!$request->isMethod('GET') && !$request->isMethod('HEAD') && !$this->isLivewireRequest($request)) {
            return $next($request);
        }

        $this->appendViewSharedVars->execute($request);

        return $next($request);
    }

    private function isLivewireRequest(Request $request): bool
    {
        return $request->hasHeader('X-Livewire');
    }
}

<?php

namespace App\Http\Middleware;

use App\Domain\Profiling\Profiler;
use Illuminate\Container\Attributes\Config;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileRequest
{
    public function __construct(
        private readonly Profiler $profiler,
        #[Config('profiling.ignore_paths', ['health-up'])]
        private readonly array $ignorePaths,
    ) {}

    public function handle(Request $request, \Closure $next): Response
    {
        if (!$request->is(...$this->ignorePaths)) {
            $this->profiler->start();
        }

        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        $this->profiler->finish([
            'http_method' => $request->method(),
            'http_route' => $request->route()?->uri() ?? 'unmatched',
        ]);
    }
}

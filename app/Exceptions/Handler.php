<?php

namespace App\Exceptions;

use App\Http\Controllers\Auth\SignIn;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    #[\Override]
    public function register()
    {
        $this->renderable($this->container->make(RenderTokenMismatch::class));

        $this->reportable($this->container->make(SkipDatabaseOffline::class));
        $this->reportable($this->container->make(SendToSentry::class));
    }

    #[\Override]
    protected function throttle(\Throwable $e)
    {
        return Limit::perDay(50);
    }

    #[\Override]
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? response()->json(['message' => $exception->getMessage()], 401)
            : redirect()->guest(path([SignIn::class, 'index']))
                ->with('message', __('auth.signin_to_view_page'));
    }
}

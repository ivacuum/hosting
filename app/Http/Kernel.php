<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        Middleware\TrimStrings::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Ivacuum\Generic\Middleware\SpammerTrap::class,
            \Ivacuum\Generic\Middleware\NoCacheHeaders::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    protected $routeMiddleware = [
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'auth' => \Ivacuum\Generic\Middleware\Auth::class,
        'admin' => Middleware\Admin::class,
        'guest' => Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'breadcrumbs' => \Ivacuum\Generic\Middleware\Breadcrumbs::class,
    ];
}

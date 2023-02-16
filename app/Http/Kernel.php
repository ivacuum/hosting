<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        Middleware\TrimStrings::class,
        Middleware\SetLocale::class,
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
            Middleware\AppendViewSharedVars::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    protected $middlewareAliases = [
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'nav' => \Ivacuum\Generic\Middleware\Breadcrumbs::class,
        'auth' => \Ivacuum\Generic\Middleware\Auth::class,
        'guest' => Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
    ];
}

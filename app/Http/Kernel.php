<?php namespace App\Http;

use App\Http\Middleware\Admin;
use App\Http\Middleware\CookieDomain;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Ivacuum\Generic\Middleware\Auth;
use Ivacuum\Generic\Middleware\Breadcrumbs;
use Ivacuum\Generic\Middleware\NoCacheHeaders;
use Ivacuum\Generic\Middleware\SpammerTrap;

class Kernel extends HttpKernel
{
    protected $middleware = [
        ValidatePostSize::class,
        TrimStrings::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            CookieDomain::class,
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            SpammerTrap::class,
            NoCacheHeaders::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    protected $routeMiddleware = [
        'can' => Authorize::class,
        'auth' => Auth::class,
        'admin' => Admin::class,
        'guest' => RedirectIfAuthenticated::class,
        'bindings' => SubstituteBindings::class,
        'throttle' => ThrottleRequests::class,
        'breadcrumbs' => Breadcrumbs::class,
    ];
}

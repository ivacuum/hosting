<?php

use App\Exceptions\RenderTokenMismatch;
use App\Exceptions\SendToSentry;
use App\Exceptions\SkipDatabaseOffline;
use App\Http\Middleware\AcpNavigation;
use App\Http\Middleware\Admin;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Symfony\Component\VarDumper\Cloner\AbstractCloner;

AbstractCloner::$defaultCasters[Carbon\CarbonInterface::class] = App\Caster\CarbonCaster::prune(...);
AbstractCloner::$defaultCasters[Carbon\CarbonInterval::class] = App\Caster\CarbonCaster::prune(...);
AbstractCloner::$defaultCasters[Illuminate\Database\Eloquent\Model::class] = App\Caster\EloquentModelCaster::prune(...);

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/health-up',
        then: function () {
            Route::prefix('')
                ->group(__DIR__ . '/../routes/simple.php');

            Route::middleware(['web', 'auth', Admin::class, AcpNavigation::class])
                ->prefix('acp')
                ->name('acp.')
                ->group(__DIR__ . '/../routes/acp.php');
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn () => to('auth/login'));
        $middleware->redirectUsersTo(fn () => to('/'));

        $middleware->append(\App\Http\Middleware\SetLocale::class);
        $middleware->append(\App\Http\Middleware\EarlyHints::class);

        $middleware->web(append: [
            \App\Http\Middleware\SpammerTrap::class,
            \App\Http\Middleware\NoCacheHeaders::class,
            \App\Http\Middleware\AppendViewSharedVars::class,
        ]);

        $middleware->trimStrings(except: ['new_password']);

        $middleware->alias([
            'nav' => \App\Http\Middleware\Breadcrumbs::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(app(RenderTokenMismatch::class));

        $exceptions->reportable(app(SkipDatabaseOffline::class));
        $exceptions->reportable(app(SendToSentry::class));

        $exceptions->throttle(fn (\Throwable $e) => Limit::perDay(50));

        $exceptions->dontTruncateRequestExceptions();
    })
    ->create();

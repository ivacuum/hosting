<?php

use App\Console\Commands;
use App\Domain\Config;
use App\Exceptions\RenderTokenMismatch;
use App\Exceptions\SendToSentry;
use App\Exceptions\SkipDatabaseOffline;
use App\Http\Middleware\AcpNavigation;
use App\Http\Middleware\Admin;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\VarDumper\Cloner\AbstractCloner;

AbstractCloner::$defaultCasters[Carbon\CarbonInterface::class] = App\Caster\CarbonCaster::prune(...);
AbstractCloner::$defaultCasters[Illuminate\Database\Eloquent\Model::class] = App\Caster\EloquentModelCaster::prune(...);

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        health: '/health-up',
        then: function () {
            \Route::prefix('')
                ->group(__DIR__ . '/../routes/simple.php');

            \Route::middleware(['web', 'auth', Admin::class, AcpNavigation::class])
                ->prefix('acp')
                ->name('acp.')
                ->group(__DIR__ . '/../routes/acp.php');
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn () => to('auth/login'));
        $middleware->redirectUsersTo(fn () => to('/'));

        $middleware->append(\App\Http\Middleware\SetLocale::class);

        $middleware->web(append: [
            \Ivacuum\Generic\Middleware\SpammerTrap::class,
            \Ivacuum\Generic\Middleware\NoCacheHeaders::class,
            \App\Http\Middleware\AppendViewSharedVars::class,
        ]);

        $middleware->trimStrings(except: ['new_password']);

        $middleware->alias([
            'nav' => \Ivacuum\Generic\Middleware\Breadcrumbs::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(app(RenderTokenMismatch::class));

        $exceptions->reportable(app(SkipDatabaseOffline::class));
        $exceptions->reportable(app(SendToSentry::class));

        $exceptions->throttle(fn (\Throwable $e) => Limit::perDay(50));

        $exceptions->dontTruncateRequestExceptions();
    })
    ->withSchedule(function (\Illuminate\Console\Scheduling\Schedule $schedule) {
        $cronOutput = Config::CronOutput->get();

        $schedule
            ->command(Commands\ProcessMetrics::class)
            ->appendOutputTo($cronOutput);

        $schedule
            ->command(Commands\TrimMetricsStream::class)
            ->cron('38 2,14 * * *')
            ->appendOutputTo($cronOutput);

        $schedule
            ->command('model:prune', [
                '--model' => [
                    \App\ExternalHttpRequest::class,
                    \App\PasswordReset::class,
                ],
            ])
            ->cron('35 2,14 * * *')
            ->appendOutputTo($cronOutput);

        $schedule->command(Commands\SitemapBuild::class)
            ->cron('30 2 * * *')
            ->appendOutputTo($cronOutput);

        // $schedule->command(Commands\WarmUpPhotoCache::class)
        //     ->cron('40 5 * * *')
        //     ->appendOutputTo($cronOutput);
        //
        // $schedule->command(Commands\WhoisUpdate::class)->cron('0 */4 * * *');

        $schedule->command(Commands\RtoUpdate::class)
            ->cron('20 */3 * * *')
            ->appendOutputTo($cronOutput);

        $schedule->command(Commands\PingDcppHubs::class)
            ->cron('25 15 * * *')
            ->appendOutputTo($cronOutput);
    })
    ->create();

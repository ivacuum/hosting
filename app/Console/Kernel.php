<?php namespace App\Console;

use App\Console\Commands\ProcessMetrics;
use App\Console\Commands\TrimMetricsStream;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * * * * * * cd /srv/www/vhosts/vhost && php artisan schedule:run >> logs/cron
     *
     * field         allowed values
     * -----         --------------
     *
     * minute        0-59
     * hour          0-23
     * day of month  1-31
     * month         1-12
     * day of week   0-7 (0 or 7 is Sun)
     */
    protected function schedule(Schedule $schedule)
    {
        $cronOutput = config('cfg.cron_output');

        $schedule
            ->command(ProcessMetrics::class)
            ->appendOutputTo($cronOutput);

        $schedule
            ->command(TrimMetricsStream::class)
            ->cron('38 2,14 * * *')
            ->appendOutputTo($cronOutput);

        $schedule
            ->command('model:prune', [
                '--model' => [
                    \App\ExternalHttpRequest::class,
                    \App\Notification::class,
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
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
    }
}

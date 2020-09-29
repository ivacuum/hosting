<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [];

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
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $cronOutput = config('cfg.cron_output');

//        $schedule->command('app:metrics-init-today')
//            ->cron('0 0 * * *')
//            ->appendOutputTo($cronOutput);

        $schedule->command(\Ivacuum\Generic\Commands\NotificationsPurge::class)
            ->cron('0 2,14 * * *')
            ->appendOutputTo($cronOutput);

        $schedule->command(\Ivacuum\Generic\Commands\PasswordRemindersPurge::class)
            ->cron('0 5 * * *')
            ->appendOutputTo($cronOutput);

        $schedule->command(Commands\ExternalHttpRequestsPurge::class)
            ->cron('0 5 * * *')
            ->appendOutputTo($cronOutput);

        $schedule->command(Commands\SitemapBuild::class)
            ->cron('30 2 * * *')
            ->appendOutputTo($cronOutput);

        $schedule->command(Commands\WarmUpPhotoCache::class)
            ->cron('0 5 * * *')
            ->appendOutputTo($cronOutput);

        $schedule->command(Commands\RtoUpdate::class)
            ->cron('0 */3 * * *')
            ->appendOutputTo($cronOutput);

        $schedule->command(Commands\PingDcppHubs::class)
            ->cron('25 15 * * *')
            ->appendOutputTo($cronOutput);

//        $schedule->command(Commands\VkLikesAdd::class, ['pn6'])
//            ->cron('5,25,45 * * * *')
//            ->appendOutputTo($cronOutput);

//        $schedule->command(Commands\VkLikesDelete::class, ['pn6'])
//            ->cron('15,35,55 * * * *')
//            ->appendOutputTo($cronOutput);

        // $schedule->command(Commands\WhoisUpdate::class)->cron('0 */4 * * *');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

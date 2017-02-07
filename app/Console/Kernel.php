<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\NotificationsPurge::class,
        Commands\RtoUpdate::class,
        Commands\VkLikesAdd::class,
        Commands\VkLikesDelete::class,
        Commands\WhoisUpdate::class,
    ];

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
        $cron_output = config('cfg.cron_output');

        $schedule->command('app:notifications-purge')->cron('0 2,14 * * *')
            ->appendOutputTo($cron_output);

        $schedule->command('app:rto-update')->cron('0 */6 * * *')
            ->appendOutputTo($cron_output);

        /*
        $schedule->command('app:vk-likes-add pn6')->cron('5,25,45 * * * *')
            ->appendOutputTo($cron_output);

        $schedule->command('app:vk-likes-delete pn6')->cron('15,35,55 * * * *')
            ->appendOutputTo($cron_output);
        */

        // $schedule->command('app:whois-update')->cron('0 */4 * * *'); // каждые 4 часа
    }

    protected function commands()
    {
        require base_path('routes/console.php');
    }
}

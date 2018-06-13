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
        $cron_output = config('cfg.cron_output');

//        $schedule->command('app:metrics-init-today')
//            ->cron('0 0 * * *')
//            ->appendOutputTo($cron_output);

        $schedule->command('app:notifications-purge')
            ->cron('0 2,14 * * *')
            ->appendOutputTo($cron_output);

        // Ежедневное удаление старых заявок на восстановление пароля
        $schedule->command('app:purge-password-reminders')
            ->cron('0 5 * * *')
            ->appendOutputTo($cron_output);

        $schedule->command(Commands\SitemapBuild::class)
            ->cron('30 2 * * *')
            ->appendOutputTo($cron_output);

        $schedule->command('app:rto-update')
            ->cron('0 */6 * * *')
            ->appendOutputTo($cron_output);

        $schedule->command('app:vk-likes-add pn6')
            ->cron('5,25,45 * * * *')
            ->appendOutputTo($cron_output);

        $schedule->command('app:vk-likes-delete pn6')
            ->cron('15,35,55 * * * *')
            ->appendOutputTo($cron_output);

        // $schedule->command('app:whois-update')->cron('0 */4 * * *'); // каждые 4 часа
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

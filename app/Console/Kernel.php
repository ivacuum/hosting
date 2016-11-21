<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
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
    */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('app:vk-likes-add pn6')->cron('5,15,25,35,45,55 * * * *');
        $schedule->command('app:vk-likes-delete pn6')->cron('0,10,20,30,40,50 * * * *');

        // $schedule->command('app:whois-update')->cron('0 */4 * * *'); // каждые 4 часа
    }
}

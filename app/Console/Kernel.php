<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
	protected $commands = [
		'App\Console\Commands\WhoisUpdate',
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
		$schedule->command('app:whois-update')
			->cron('0 */4 * * *') // каждые 4 часа
			->sendOutputTo(base_path().'/logs/cron');
	}
}

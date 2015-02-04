<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
	protected $commands = [
		'App\Console\Commands\WhoisUpdate',
	];

	protected function schedule(Schedule $schedule)
	{
		// $schedule->command('inspire')
		// 	->hourly();
	}
}

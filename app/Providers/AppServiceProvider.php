<?php namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	public function boot()
	{
	}

	public function register()
	{
		setlocale(LC_ALL, config('app.setlocale'));
		
		Carbon::setLocale('ru');
		
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}
}

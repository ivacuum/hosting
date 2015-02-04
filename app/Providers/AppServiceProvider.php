<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	public function boot()
	{
	}

	public function register()
	{
		setlocale(LC_ALL, config('app.setlocale'));
		
		require_once app_path().'/helpers.php';
		
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}
}

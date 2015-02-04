<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app['view']->addExtension('html', 'blade');
	}
}

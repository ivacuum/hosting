<?php namespace App\Providers;

use App\Domain;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
	protected $namespace = 'App\Http\Controllers';

	public function boot(Router $router)
	{
		parent::boot($router);
		
		$router->bind('Domain', function($value) {
			return Domain::whereDomain($value)->firstOrFail();
		});
		
		$router->model('Client', 'App\Client');
		$router->model('Page', 'App\Page');
		$router->model('User', 'App\User');
		$router->model('YandexUser', 'App\YandexUser');
	}

	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router) {
			require app_path('Http/routes.php');
		});
	}
}

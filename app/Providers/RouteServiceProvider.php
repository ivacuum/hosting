<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public function boot(Router $router)
    {
        parent::boot($router);

        $router->model('Client', 'App\Client');
        $router->model('Domain', 'App\Domain');
        $router->model('Page', 'App\Page');
        $router->model('Server', 'App\Server');
        $router->model('User', 'App\User');
        $router->model('YandexUser', 'App\YandexUser');
    }

    public function map(Router $router)
    {
        $router->group([
            'namespace'   => $this->namespace,
            'prefix'      => 'acp',
            'breadcrumbs' => [['Админка', 'acp']],
            'middleware'  => ['web', 'auth', 'admin'],
        ], function ($router) {
            require app_path('Http/routes_acp.php');
        });

        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes_simple.php');
        });

        $router->group([
            'namespace'  => $this->namespace,
            'middleware' => 'web'
        ], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}

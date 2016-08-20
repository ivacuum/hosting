<?php

namespace App\Providers;

use App\City;
use App\Client;
use App\Country;
use App\Domain;
use App\Page;
use App\Server;
use App\Trip;
use App\User;
use App\YandexUser;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public function boot(Router $router)
    {
        parent::boot($router);

        $router->model('City', City::class);
        $router->model('Client', Client::class);
        $router->model('Country', Country::class);
        $router->model('Domain', Domain::class);
        $router->model('Page', Page::class);
        $router->model('Server', Server::class);
        $router->model('Trip', Trip::class);
        $router->model('User', User::class);
        $router->model('YandexUser', YandexUser::class);
    }

    public function map(Router $router, Request $request)
    {
        $router->group([
            'namespace'   => $this->namespace,
            'prefix'      => 'acp',
            'breadcrumbs' => [['Админка', 'acp']],
            'middleware'  => ['web', 'auth', 'admin'],
        ], function ($router) {
            require base_path('routes/acp.php');
        });

        $router->group(['namespace' => $this->namespace], function ($router) {
            require base_path('routes/simple.php');
        });

        $router->group([
            'namespace'  => $this->namespace,
            'middleware' => 'web'
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }
}

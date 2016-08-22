<?php

namespace App\Providers;

use App;
use App\City;
use App\Client;
use App\Country;
use App\Domain;
use App\Gig;
use App\Page;
use App\Server;
use App\Trip;
use App\User;
use App\YandexUser;
use Carbon\Carbon;
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
        $router->model('Gig', Gig::class);
        $router->model('Page', Page::class);
        $router->model('Server', Server::class);
        $router->model('Trip', Trip::class);
        $router->model('User', User::class);
        $router->model('YandexUser', YandexUser::class);
    }

    public function map(Router $router, Request $request)
    {
        $prefix = $this->getLocalePrefix($request);

        $router->group([
            'namespace'   => $this->namespace,
            'prefix'      => "{$prefix}/acp",
            'middleware'  => ['web', 'auth', 'admin'],
        ], function ($router) {
            require base_path('routes/acp.php');
        });

        $router->group(['namespace' => $this->namespace], function ($router) {
            require base_path('routes/simple.php');
        });

        $router->group([
            'namespace'  => $this->namespace,
            'middleware' => 'web',
            'prefix'     => $prefix,
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }

    protected function getLocalePrefix(Request $request)
    {
        $default_locale = config('app.locale');
        $locale = $request->segment(1);

        if (in_array($locale, array_keys(config('cfg.locales')))) {
        } else {
            $locale = $default_locale;
        }

        setlocale(LC_ALL, config("cfg.locales.{$locale}.posix"));
        Carbon::setLocale($locale);

        if ($locale === $default_locale) {
            $locale = '';
        } else {
            App::setLocale($locale);
        }

        return $locale;
    }
}

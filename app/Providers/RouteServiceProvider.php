<?php namespace App\Providers;

use App;
use App\Artist;
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
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {
        parent::boot();

        Route::model('Artist', Artist::class);
        Route::model('City', City::class);
        Route::model('Client', Client::class);
        Route::model('Country', Country::class);
        Route::model('Domain', Domain::class);
        Route::model('Gig', Gig::class);
        Route::model('Page', Page::class);
        Route::model('Server', Server::class);
        Route::model('Trip', Trip::class);
        Route::model('User', User::class);
        Route::model('YandexUser', YandexUser::class);
    }

    public function map()
    {
        $prefix = $this->getLocalePrefix();

        Route::group([
            'namespace'   => $this->namespace,
            'prefix'      => "{$prefix}/acp",
            'middleware'  => ['web', 'auth', 'admin'],
        ], function ($router) {
            require base_path('routes/acp.php');
        });

        Route::group(['namespace' => $this->namespace], function ($router) {
            require base_path('routes/simple.php');
        });

        Route::group([
            'namespace'  => $this->namespace,
            'middleware' => 'web',
            'prefix'     => $prefix,
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }

    protected function getLocalePrefix()
    {
        $default_locale = config('app.locale');
        $locale = Request::segment(1);

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

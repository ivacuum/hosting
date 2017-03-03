<?php namespace App\Providers;

use App\Artist;
use App\City;
use App\Client;
use App\Comment;
use App\Country;
use App\Domain;
use App\File;
use App\Gig;
use App\Image;
use App\News;
use App\Page;
use App\Server;
use App\Torrent;
use App\Trip;
use App\User;
use App\YandexUser;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {
        \Route::pattern('id', '\d+');

        parent::boot();

        \Route::model('Artist', Artist::class);
        \Route::model('City', City::class);
        \Route::model('Client', Client::class);
        \Route::model('Comment', Comment::class);
        \Route::model('Country', Country::class);
        \Route::model('Domain', Domain::class);
        \Route::model('File', File::class);
        \Route::model('Gig', Gig::class);
        \Route::model('Image', Image::class);
        \Route::model('News', News::class);
        \Route::model('Page', Page::class);
        \Route::model('Server', Server::class);
        \Route::model('Torrent', Torrent::class);
        \Route::model('Trip', Trip::class);
        \Route::model('User', User::class);
        \Route::model('YandexUser', YandexUser::class);

        \Route::bind('NewsWithCounts', function ($id) {
            return News::withCount('comments')->findOrFail($id);
        });
    }

    public function map()
    {
        $prefix = $this->getLocalePrefix();

        \Route::namespace($this->namespace)
            ->group(base_path('routes/simple.php'));

        \Route::middleware(['web', 'auth', 'admin'])
            ->namespace($this->namespace)
            ->prefix("{$prefix}/acp")
            ->group(base_path('routes/acp.php'));

        \Route::middleware('web')
            ->namespace($this->namespace)
            ->prefix($prefix)
            ->group(base_path('routes/web.php'));
    }

    protected function getLocalePrefix()
    {
        $default_locale = config('app.locale');
        $locale = \Request::segment(1);

        if (in_array($locale, array_keys(config('cfg.locales')))) {
        } else {
            $locale = $default_locale;
        }

        setlocale(LC_ALL, config("cfg.locales.{$locale}.posix"));
        Carbon::setLocale($locale);

        if ($locale === $default_locale) {
            $locale = '';
        } else {
            \App::setLocale($locale);
        }

        return $locale;
    }
}

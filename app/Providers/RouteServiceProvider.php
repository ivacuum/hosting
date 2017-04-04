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
use App\Photo;
use App\Server;
use App\Tag;
use App\Torrent;
use App\Trip;
use App\User;
use App\YandexUser;
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
        \Route::model('Photo', Photo::class);
        \Route::model('Server', Server::class);
        \Route::model('Tag', Tag::class);
        \Route::model('Torrent', Torrent::class);
        \Route::model('Trip', Trip::class);
        \Route::model('User', User::class);
        \Route::model('YandexUser', YandexUser::class);

        \Route::bind('UserWithCounts', function ($id) {
            return User::withCount('comments', 'images', 'torrents')->findOrFail($id);
        });
    }

    public function map()
    {
        \Route::namespace($this->namespace)
            ->group(base_path('routes/simple.php'));

        \Route::middleware(['web', 'auth', 'admin'])
            ->namespace($this->namespace)
            ->prefix('acp')
            ->group(base_path('routes/acp.php'));

        \Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }
}

<?php namespace App\Providers;

use App\File;
use App\Image;
use App\Tag;
use App\Torrent;
use App\Trip;
use App\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {
        \Route::pattern('id', '\d+');

        parent::boot();

        \Route::model('File', File::class);
        \Route::model('Image', Image::class);
        \Route::model('Tag', Tag::class);
        \Route::model('Torrent', Torrent::class);
        \Route::model('Trip', Trip::class);
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

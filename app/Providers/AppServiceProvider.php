<?php namespace App\Providers;

use App\News;
use App\Photo;
use App\Torrent;
use App\Trip;
use App\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap([
            'News' => News::class,
            'Trip' => Trip::class,
            'User' => User::class,
            'Photo' => Photo::class,
            'Torrent' => Torrent::class,
        ]);
    }
}

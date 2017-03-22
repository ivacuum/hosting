<?php namespace App\Providers;

use App\News;
use App\Photo;
use App\Torrent;
use App\Trip;
use App\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Ivacuum\Generic\Providers\BladeTrait;
use Ivacuum\Generic\Providers\DebugbarTrait;
use Ivacuum\Generic\Providers\FastcgiTrait;

class AppServiceProvider extends ServiceProvider
{
    use BladeTrait, DebugbarTrait, FastcgiTrait;

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

    public function register()
    {
        $this->bladeLang();
        $this->bladeSvg();
        $this->debugbar();
        $this->fastcgiFinishRequest();
    }
}

<?php namespace App\Providers;

use App\Artist;
use App\City;
use App\Client;
use App\Comment;
use App\Country;
use App\Domain;
use App\ExternalIdentity;
use App\File;
use App\Gig;
use App\Image;
use App\News;
use App\Page;
use App\Photo;
use App\Policies\Base;
use App\Policies\WithoutCreate;
use App\Policies\WithoutCreateAndEdit;
use App\Server;
use App\Socialite\VkProvider;
use App\Tag;
use App\Torrent;
use App\Trip;
use App\User;
use App\YandexUser;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Gig::class => Base::class,
        Tag::class => Base::class,
        City::class => Base::class,
        File::class => Base::class,
        News::class => Base::class,
        Page::class => Base::class,
        Trip::class => Base::class,
        User::class => WithoutCreate::class,
        Image::class => WithoutCreateAndEdit::class,
        Photo::class => Base::class,
        Artist::class => Base::class,
        Client::class => Base::class,
        Domain::class => Base::class,
        Server::class => Base::class,
        Comment::class => WithoutCreate::class,
        Country::class => Base::class,
        Torrent::class => WithoutCreate::class,
        YandexUser::class => Base::class,
        ExternalIdentity::class => WithoutCreateAndEdit::class,
    ];

    public function boot()
    {
        parent::registerPolicies();

        $this->app->singleton(VkProvider::class, function ($app) {
            $config = $app['config']['services.vk'];

            return new VkProvider(
                $app['request'],
                $config['client_id'],
                $config['client_secret'],
                $config['redirect']
            );
        });
    }
}

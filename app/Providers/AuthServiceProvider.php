<?php namespace App\Providers;

use App;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Ivacuum\Generic\Policies\Base;
use Ivacuum\Generic\Policies\WithoutCreate;
use Ivacuum\Generic\Policies\WithoutCreateAndEdit;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        App\Gig::class => Base::class,
        App\Tag::class => Base::class,
        App\City::class => Base::class,
        App\File::class => Base::class,
        App\News::class => Base::class,
        App\Page::class => Base::class,
        App\Trip::class => App\Policies\TripPolicy::class,
        App\User::class => WithoutCreate::class,
        App\Image::class => WithoutCreateAndEdit::class,
        App\Issue::class => WithoutCreateAndEdit::class,
        App\Kanji::class => WithoutCreate::class,
        App\Photo::class => Base::class,
        App\Artist::class => Base::class,
        App\Client::class => Base::class,
        App\Domain::class => Base::class,
        App\Server::class => Base::class,
        App\Comment::class => App\Policies\CommentPolicy::class,
        App\Country::class => Base::class,
        App\DcppHub::class => Base::class,
        App\Radical::class => WithoutCreate::class,
        App\Torrent::class => WithoutCreate::class,
        App\Vocabulary::class => WithoutCreate::class,
        App\YandexUser::class => Base::class,
        App\ChatMessage::class => WithoutCreate::class,
        App\Notification::class => WithoutCreateAndEdit::class,
        App\ExternalIdentity::class => WithoutCreateAndEdit::class,
        App\ExternalHttpRequest::class => WithoutCreateAndEdit::class,
    ];

    public function boot()
    {
        parent::registerPolicies();
    }
}

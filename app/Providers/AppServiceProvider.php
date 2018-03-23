<?php namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap([
            'Gig' => \App\Gig::class,
            'Tag' => \App\Tag::class,
            'City' => \App\City::class,
            'File' => \App\File::class,
            'News' => \App\News::class,
            'Page' => \App\Page::class,
            'Trip' => \App\Trip::class,
            'User' => \App\User::class,
            'Image' => \App\Image::class,
            'Kanji' => \App\Kanji::class,
            'Photo' => \App\Photo::class,
            'Artist' => \App\Artist::class,
            'Client' => \App\Client::class,
            'Domain' => \App\Domain::class,
            'Server' => \App\Server::class,
            'Comment' => \App\Comment::class,
            'Country' => \App\Country::class,
            'Radical' => \App\Radical::class,
            'Torrent' => \App\Torrent::class,
            'Vocabulary' => \App\Vocabulary::class,
            'YandexUser' => \App\YandexUser::class,
            'ChatMessage' => \App\ChatMessage::class,
            'ExternalIdentity' => \App\ExternalIdentity::class,
        ]);

        \App\Comment::observe(\App\Observers\CommentObserver::class);
    }
}

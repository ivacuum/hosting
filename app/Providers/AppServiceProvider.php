<?php namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Blade::withoutDoubleEncoding();

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
            'Issue' => \App\Issue::class,
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

        \App\Tag::observe(\App\Observers\TagObserver::class);
        \App\City::observe(\App\Observers\CityObserver::class);
        \App\News::observe(\App\Observers\NewsObserver::class);
        \App\Trip::observe(\App\Observers\TripObserver::class);
        \App\User::observe(\App\Observers\UserObserver::class);
        \App\Email::observe(\App\Observers\EmailObserver::class);
        \App\Image::observe(\App\Observers\ImageObserver::class);
        \App\Issue::observe(\App\Observers\IssueObserver::class);
        \App\Kanji::observe(\App\Observers\KanjiObserver::class);
        \App\Photo::observe(\App\Observers\PhotoObserver::class);
        \App\Domain::observe(\App\Observers\DomainObserver::class);
        \App\Comment::observe(\App\Observers\CommentObserver::class);
        \App\Country::observe(\App\Observers\CountryObserver::class);
        \App\Radical::observe(\App\Observers\RadicalObserver::class);
        \App\Torrent::observe(\App\Observers\TorrentObserver::class);
        \App\Vocabulary::observe(\App\Observers\VocabularyObserver::class);
        \App\YandexUser::observe(\App\Observers\YandexUserObserver::class);
    }
}

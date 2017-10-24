<?php namespace App\Providers;

use App\Listeners\DeletePhotoFiles;
use App\Listeners\EmailWhoisChanges;
use App\Listeners\ForgetTripsCache;
use App\Listeners\LogUserLogin;
use App\Listeners\ToggleTripPhotosStatus;
use App\Listeners\TripPhotosSlugPrefixUpdate;
use App\Listeners\UserEmptySalt;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'eloquent.saved: App\City' => [ForgetTripsCache::class],
        'eloquent.deleted: App\Photo' => [DeletePhotoFiles::class],
        'eloquent.saved: App\Trip' => [
            ToggleTripPhotosStatus::class,
            ForgetTripsCache::class
        ],
        'eloquent.updated: App\Trip' => [TripPhotosSlugPrefixUpdate::class],

        'App\Events\DomainWhoisUpdated' => [EmailWhoisChanges::class],

        'Illuminate\Auth\Events\Login' => [
            UserEmptySalt::class,
            LogUserLogin::class
        ],

        'Ivacuum\Generic\Events\LimitExceeded' => [
            \Ivacuum\Generic\Listeners\TelegramLimitExceeded::class,
        ],
    ];
}

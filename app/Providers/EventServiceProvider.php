<?php namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'eloquent.saved: App\City' => ['App\Listeners\ForgetTripsCache'],
        'eloquent.deleted: App\City' => ['App\Listeners\ForgetTripsCache'],
        'eloquent.deleted: App\Photo' => ['App\Listeners\DeletePhotoFiles'],
        'eloquent.saved: App\Trip' => [
            'App\Listeners\ToggleTripPhotosStatus',
            'App\Listeners\ForgetTripsCache',
        ],
        'eloquent.updated: App\Trip' => ['App\Listeners\TripPhotosSlugPrefixUpdate'],

        'App\Events\DomainWhoisUpdated' => ['App\Listeners\EmailWhoisChanges'],

        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\UserEmptySalt',
            'App\Listeners\LogUserLogin',
        ],

        'Ivacuum\Generic\Events\LimitExceeded' => [
            'Ivacuum\Generic\Listeners\TelegramLimitExceeded',
        ],
    ];
}

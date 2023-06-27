<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Illuminate\Foundation\Events\LocaleUpdated' => [
            'Ivacuum\Generic\Listeners\SetLocale',
        ],

        'Ivacuum\Generic\Events\MailReported' => [
            'Ivacuum\Generic\Listeners\TelegramMailReport',
        ],
    ];

    public function shouldDiscoverEvents()
    {
        return true;
    }
}

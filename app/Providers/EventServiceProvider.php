<?php namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'App\Events\CommentPublished' => ['App\Listeners\NotifyUsersAboutComment'],
        'App\Events\DomainWhoisUpdated' => ['App\Listeners\EmailWhoisChanges'],

        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\UserEmptySalt',
            'App\Listeners\LogUserLogin',
        ],

        'Ivacuum\Generic\Events\LimitExceeded' => [
            'Ivacuum\Generic\Listeners\TelegramLimitExceeded',
        ],

        'Ivacuum\Generic\Events\MailReported' => [
            'Ivacuum\Generic\Listeners\TelegramMailReport',
        ],
    ];
}

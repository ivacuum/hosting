<?php namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'App\Events\ChatMessageCreated' => ['App\Listeners\TelegramChatMessage'],
        'App\Events\CommentPublished' => ['App\Listeners\NotifyUsersAboutComment'],
        'App\Events\DomainWhoisUpdated' => ['App\Listeners\EmailWhoisChanges'],
        'App\Events\IssueCreated' => ['App\Listeners\TelegramIssue'],
        'App\Events\TypoReceived' => ['App\Listeners\TelegramTypo'],

        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\UserEmptySalt',
            'App\Listeners\LogUserLogin',
        ],

        'Illuminate\Foundation\Events\LocaleUpdated' => [
            'Ivacuum\Generic\Listeners\SetLocale',
        ],

        'Ivacuum\Generic\Events\LimitExceeded' => [
            'Ivacuum\Generic\Listeners\TelegramLimitExceeded',
        ],

        'Ivacuum\Generic\Events\MailReported' => [
            'Ivacuum\Generic\Listeners\TelegramMailReport',
        ],
    ];
}

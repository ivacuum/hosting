<?php namespace App\Providers;

use App\Events;
use App\Listeners;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Events\ChatMessageCreated::class => [Listeners\TelegramChatMessage::class],
        Events\CommentPublished::class => [Listeners\NotifyUsersAboutComment::class],
        Events\DomainWhoisUpdated::class => [Listeners\EmailWhoisChanges::class],
        Events\IssueCreated::class => [Listeners\TelegramIssue::class],
        Events\TypoReceived::class => [Listeners\TelegramTypo::class],

        'Illuminate\Auth\Events\Login' => [
            Listeners\UserEmptySalt::class,
            Listeners\LogUserLogin::class,
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

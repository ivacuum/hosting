<?php namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\DomainWhoisUpdated::class => [
            \App\Listeners\EmailWhoisChanges::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}

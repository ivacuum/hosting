<?php

namespace App\Providers;

class EventServiceProvider extends \Illuminate\Foundation\Support\Providers\EventServiceProvider
{
    #[\Override]
    public function boot(): void
    {
        self::addEventDiscoveryPaths([
            $this->app->path('Listeners'),
            $this->app->path('Domain/*/Listener'),
        ]);
    }
}

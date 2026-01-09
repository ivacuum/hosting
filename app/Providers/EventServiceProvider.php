<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    #[\Override]
    public function boot()
    {
        self::addEventDiscoveryPaths([
            $this->app->path('Listeners'),
            $this->app->path('Domain/*/Listener'),
        ]);
    }
}

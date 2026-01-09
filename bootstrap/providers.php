<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\DebugbarServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
    App\Providers\SphinxServiceProvider::class,
    App\Providers\ScoutServiceProvider::class,
    App\Providers\SocialiteServiceProvider::class,
    App\Domain\Metrics\Provider\MetricsServiceProvider::class,
];

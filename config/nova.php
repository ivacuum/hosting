<?php

use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Http\Middleware\Authenticate;
use Laravel\Nova\Http\Middleware\Authorize;
use Laravel\Nova\Http\Middleware\BootTools;
use Laravel\Nova\Http\Middleware\DispatchServingNovaEvent;

return [

    'name' => env('NOVA_APP_NAME', env('APP_NAME')),
    'url' => env('APP_URL', '/'),
    'path' => '/nova',
    'guard' => env('NOVA_GUARD', null),
    'passwords' => env('NOVA_PASSWORDS', null),

    'middleware' => [
        'web',
        Authenticate::class,
        DispatchServingNovaEvent::class,
        BootTools::class,
        Authorize::class,
    ],

    // simple, load-more, links
    'pagination' => 'simple',

    'actions' => [
        'resource' => ActionResource::class,
    ],

];

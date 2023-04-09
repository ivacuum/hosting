<?php

return [
    'driver' => env('SCOUT_DRIVER', 'sphinx'),
    'prefix' => env('SCOUT_PREFIX', 'vac_'),
    'queue' => env('SCOUT_QUEUE', false),
    'after_commit' => true,

    'chunk' => [
        'searchable' => 500,
        'unsearchable' => 500,
    ],

    'soft_delete' => false,

    'algolia' => [
        'id' => env('ALGOLIA_APP_ID', ''),
        'secret' => env('ALGOLIA_SECRET', ''),
    ],
];

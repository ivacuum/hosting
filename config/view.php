<?php

return [

    'paths' => [
        resource_path('views'),
        realpath(base_path('vendor/ivacuum/generic/views')),
    ],

    'compiled' => realpath(storage_path('framework/views')),

];

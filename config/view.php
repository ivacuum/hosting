<?php

return [

    'paths' => [
        realpath(base_path('resources/views')),
        realpath(base_path('vendor/ivacuum/generic/views'))
    ],

    'compiled' => realpath(storage_path('framework/views')),

];

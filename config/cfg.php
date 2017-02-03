<?php

return [

    'avatar_bg' => [
        '#f44336',
        '#e91e63',
        '#9c27b0',
        '#673ab7',
        '#3f51b5',
        '#2196f3',
        '#03a9f4',
        '#00bcd4',
        '#009688',
        '#4caf50',
        '#8bc34a',
        '#cddc39',
        '#ffc107',
        '#ff9800',
        '#ff5722',
    ],
    'cron_output' => env('CRON_OUTPUT', '/dev/null'),
    'default_locale' => 'ru',
    'gm_bin' => env('GM_BIN', '/usr/bin/env gm'),
    'locales' => [
        'ru' => ['posix' => 'ru_RU.UTF-8'],
        'en' => ['posix' => 'en_US.UTF-8'],
    ],
    'sitename' => 'vacuum.kaluga',

];

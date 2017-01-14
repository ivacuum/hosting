<?php

return [

    'cron_output' => env('CRON_OUTPUT', '/dev/null'),
    'default_locale' => 'ru',
    'gm_bin' => env('GM_BIN', '/usr/bin/env gm'),
    'locales' => [
        'ru' => ['posix' => 'ru_RU.UTF-8'],
        'en' => ['posix' => 'en_US.UTF-8'],
    ],
    'sitename' => 'vacuum.kaluga',

];

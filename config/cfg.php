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
    'autoregister_suffixes_blacklist' => ['@ivacuum.org', '@ivacuum.ru', '@vacuum.name'],
    'cron_output' => env('CRON_OUTPUT', '/dev/null'),
    'gm_bin' => env('GM_BIN', '/usr/bin/env gm convert'),
    'limits' => [
        'issue' => [
            'ip' => 100,
            'user' => 50,
            'flood_interval' => 2,
        ],
        'comment' => [
            'ip' => 100,
            'user' => 50,
            'flood_interval' => 2,
        ],
    ],
    'locales' => [
        App\Domain\Locale::Rus->value => ['posix' => 'ru_RU.UTF-8'],
        App\Domain\Locale::Eng->value => ['posix' => 'en_US.UTF-8'],
    ],
    'metrics_address' => env('METRICS_ADDRESS'),
    'sitename' => 'vacuum.kaluga',
    'sphinx' => [
        'host' => env('SPHINX_HOST', 'localhost'),
        'port' => env('SPHINX_PORT', 9306),
        'socket' => env('SPHINX_SOCKET', ''),
    ],
    'telegram' => [
        'admin_id' => env('TELEGRAM_ADMIN_ID', 0),
        'bot_token' => env('TELEGRAM_BOT_TOKEN', 'YOUR-BOT-TOKEN'),
        'webhook_secret_token' => env('TELEGRAM_WEBHOOK_SECRET_TOKEN'),
    ],
    'torrent_anonymous_releaser' => env('TORRENT_ANONYMOUS_RELEASER', 3),
    'wanikani_api_key' => env('WANIKANI_API_KEY', ''),

    // Купоны
    'airbnb_link' => 'c/spankov1?s=8',
    'booking_link' => 'https://www.booking.com/s/34_6/f4544993',
    'digitalocean_link' => 'https://m.do.co/c/0864de50ab6c',
    'drimsim_link' => 'https://drimsim.app.link/3SdHuoxSLN',
    'firstvds_link' => 'https://firstvds.ru/?from=149161',
    'firstvds_promocode' => '648149161',
    'timeweb_link' => '?i=19980',
];

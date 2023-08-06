<?php

return [
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT'),
    ],

    'rto' => [
        'proxy' => env('RTO_PROXY'),
    ],

    'telegram' => [
        'admin_id' => env('TELEGRAM_ADMIN_ID', 0),
        'bot_token' => env('TELEGRAM_BOT_TOKEN', 'YOUR-BOT-TOKEN'),
        'webhook_secret_token' => env('TELEGRAM_WEBHOOK_SECRET_TOKEN'),
    ],

    'vk' => [
        'access_token' => env('VK_ACCESS_TOKEN'),
        'client_id' => env('VK_CLIENT_ID'),
        'client_secret' => env('VK_CLIENT_SECRET'),
        'redirect' => env('VK_REDIRECT'),
    ],

    'wanikani' => [
        'api_key' => env('WANIKANI_API_KEY', 'YourWanikaniToken'),
    ],
];

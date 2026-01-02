<?php

return [
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT'),
    ],

    'instagram' => [
        'webhook_verify_token' => env('INSTAGRAM_WEBHOOK_VERIFY_TOKEN', 'example'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT'),
    ],

    'rto' => [
        'proxy' => env('RTO_PROXY'),
    ],

    'ollama' => [
        'base_url' => env('OLLAMA_API_BASE_URL', 'http://localhost:11434/api/'),
    ],

    'telegram' => [
        'admin_id' => (int) env('TELEGRAM_ADMIN_ID', 0),
        'bot_token' => env('TELEGRAM_BOT_TOKEN', 'YOUR-BOT-TOKEN'),
        'bot_username' => env('TELEGRAM_BOT_USERNAME', 'ExampleBot'),
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

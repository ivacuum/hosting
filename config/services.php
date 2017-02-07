<?php

return [

    'mailgun' => [
        'domain' => '',
        'secret' => '',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => '',
        'secret' => '',
    ],

    'facebook' => [
        'client_id'     => env('FACEBOOK_CLIENT_ID', ''),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET', ''),
        'redirect'      => env('FACEBOOK_REDIRECT', ''),
    ],

    'google' => [
        'client_id'     => env('GOOGLE_CLIENT_ID', ''),
        'client_secret' => env('GOOGLE_CLIENT_SECRET', ''),
        'redirect'      => env('GOOGLE_REDIRECT', ''),
    ],

    'vk' => [
        'access_token'  => env('VK_ACCESS_TOKEN', ''),
        'client_id'     => env('VK_CLIENT_ID', ''),
        'client_secret' => env('VK_CLIENT_SECRET', ''),
        'redirect'      => env('VK_REDIRECT', ''),
    ],

];

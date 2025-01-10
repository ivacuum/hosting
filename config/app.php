<?php

return [
    'name' => env('APP_NAME', 'vacuum.name'),
    'asset_url' => env('ASSET_URL', '/'),
    'timezone' => env('APP_TIMEZONE', 'Europe/Moscow'),
    'locale' => env('APP_LOCALE', 'ru'),
    'editor' => env('APP_EDITOR', 'phpstorm'),

    'aliases' => \Illuminate\Support\Facades\Facade::defaultAliases()->merge([
        'Acp' => App\Facades\Acp::class,
        'UrlHelper' => App\Facades\UrlHelper::class,
        'CityHelper' => App\Facades\CityHelper::class,
        'ViewHelper' => App\Facades\ViewHelper::class,
        'CountryHelper' => App\Facades\CountryHelper::class,
        'TorrentCategoryHelper' => App\Facades\TorrentCategoryHelper::class,
    ])->toArray(),
];

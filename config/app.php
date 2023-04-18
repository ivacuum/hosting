<?php

return [
    'name' => env('APP_NAME', 'vacuum.name'),
    'env' => env('APP_ENV', 'production'),
    'debug' => env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    'asset_url' => env('ASSET_URL', '/'),
    'timezone' => 'Europe/Moscow',
    'locale' => 'ru',
    'fallback_locale' => 'en',
    'key' => env('APP_KEY'),
    'cipher' => 'AES-256-CBC',
    'editor' => 'phpstorm',

    'providers' => \Illuminate\Support\ServiceProvider::defaultProviders()->merge([
        App\Providers\AppServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\LivewireServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Domain\Metrics\Provider\MetricsServiceProvider::class,
    ])->toArray(),

    'aliases' => \Illuminate\Support\Facades\Facade::defaultAliases()->merge([
        'Acp' => App\Facades\Acp::class,
        'UrlHelper' => App\Facades\UrlHelper::class,
        'CityHelper' => App\Facades\CityHelper::class,
        'ViewHelper' => App\Facades\ViewHelper::class,
        'CountryHelper' => App\Facades\CountryHelper::class,
        'TorrentCategoryHelper' => App\Facades\TorrentCategoryHelper::class,
    ])->toArray(),
];

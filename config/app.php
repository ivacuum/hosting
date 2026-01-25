<?php

return [
    'name' => env('APP_NAME', 'vacuum.name'),
    'asset_url' => env('ASSET_URL', '/'),
    'timezone' => env('APP_TIMEZONE', 'Europe/Moscow'),
    'locale' => env('APP_LOCALE', App\Domain\Locale::Rus->value),
    'editor' => env('APP_EDITOR', 'phpstorm'),

    'aliases' => \Illuminate\Support\Facades\Facade::defaultAliases()->merge([
        'Acp' => App\Facades\Acp::class,
        'Form' => App\Facades\Form::class,
        'UrlHelper' => App\Facades\UrlHelper::class,
        'CityHelper' => App\Facades\CityHelper::class,
        'ViewHelper' => App\Facades\ViewHelper::class,
        'Breadcrumbs' => App\Facades\Breadcrumbs::class,
        'LivewireForm' => App\Facades\LivewireForm::class,
        'CountryHelper' => App\Facades\CountryHelper::class,
        'TorrentCategoryHelper' => App\Facades\TorrentCategoryHelper::class,
    ])->toArray(),
];

<?php

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__ . '/../vendor/autoload.php';

/** @var \Illuminate\Foundation\Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

$request = Illuminate\Http\Request::capture();

$appConfig = require __DIR__ . '/../config/app.php';
$myConfig = require __DIR__ . '/../config/cfg.php';

$locale = $request->segment(1);
$locales = $myConfig['locales'];
$defaultLocale = $appConfig['locale'];

if (is_array($locales) && in_array($locale, array_keys($locales)) && $locale !== $defaultLocale) {
    $_SERVER['LARAVEL_LOCALE'] = $locale;

    // /en/news => //news
    // /en?something => /?something
    $requestUri = substr_replace($request->getRequestUri(), '', 1, strlen($locale));

    // //news => /news
    $requestUri = str_starts_with($requestUri, '//')
        ? substr_replace($requestUri, '', 0, 1)
        : $requestUri;

    // Так можно кэшировать маршруты без указания локализации
    // Но приходится сложнее строить ссылки
    $_SERVER['REQUEST_URI'] = $requestUri;
} elseif ($request->server->get('HTTP_SITE_LOCALE')) {
    $_SERVER['LARAVEL_LOCALE'] = $request->server->get('HTTP_SITE_LOCALE');
}

$app->handleRequest(Illuminate\Http\Request::capture());

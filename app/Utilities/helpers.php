<?php

if (!function_exists('canonical')) {
    // Канонический адрес текущей страницы
    function canonical(): string
    {
        $request = app('request');

        $locale = $request->server->get('LARAVEL_LOCALE') ?? null;
        $prefix = $locale ? "/{$locale}" : '';

        $path = $prefix . $request->getPathInfo();
        $suffix = $path === '/' ? '/' : '';

        return rtrim($request->root() . $prefix . $request->getPathInfo(), '/') . $suffix;
    }
}

if (!function_exists('fullUrl')) {
    // Адрес текущей страницы с произвольными параметрами
    function fullUrl(array $params = []): string
    {
        $request = app('request');

        if ($request->getQueryString() === null) {
            if (empty($params)) {
                return canonical();
            }

            return canonical() . '?' . http_build_query($params);
        }

        return canonical() . '?' . http_build_query(array_merge($request->query(), $params));
    }
}

if (!function_exists('path')) {
    // Адрес страницы, соответствующий контроллеру
    function path($name, $parameters = [], bool $absolute = false): string
    {
        $locale = app('request')->server->get('LARAVEL_LOCALE') ?? null;
        $prefix = $locale ? "/{$locale}" : '';

        if (!$prefix) {
            return app('url')->action($name, $parameters, $absolute);
        }

        $action = app('url')->action($name, $parameters, false);

        return ($absolute ? app('request')->root() : '') . $prefix . ($action === '/' ? '' : $action);
    }
}

if (!function_exists('path_locale')) {
    // Адрес страницы, соответствующий контроллеру
    function path_locale($name, $parameters = [], bool $absolute = false, string $locale = ''): string
    {
        $prefix = $locale !== 'ru' ? "/{$locale}" : '';

        if (!$prefix) {
            return app('url')->action($name, $parameters, $absolute);
        }

        $action = app('url')->action($name, $parameters, false);

        return ($absolute ? app('request')->root() : '') . $prefix . ($action === '/' ? '' : $action);
    }
}

if (!function_exists('to')) {
    function to(string $url, $params = []): string
    {
        $locale = app('request')->server->get('LARAVEL_LOCALE');

        $route = new Illuminate\Routing\Route('', trim("{$locale}/{$url}", '/'), '');

        return app('url')->toRoute($route, $params, false);
    }
}

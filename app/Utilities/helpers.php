<?php

if (!function_exists('canonical')) {
    // Канонический адрес текущей страницы
    function canonical(): string
    {
        return app('request')->url();
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
        $locale = app()->getLocale();
        $defaultLocale = App\Domain\Config::DefaultLocale->get();
        $prefix = $locale !== $defaultLocale ? "/{$locale}" : '';

        if (!$prefix) {
            return app('url')->action($name, $parameters, $absolute);
        }

        $action = app('url')->action($name, $parameters, false);

        if (str_starts_with($action, $prefix)) {
            $path = $action;
        } else {
            $path = $prefix . ($action === '/' ? '' : $action);
        }

        return ($absolute ? app('request')->root() : '') . $path;
    }
}

if (!function_exists('path_locale')) {
    // Адрес страницы, соответствующий контроллеру
    function path_locale($name, $parameters = [], bool $absolute = false, string $locale = ''): string
    {
        $defaultLocale = App\Domain\Config::DefaultLocale->get();
        $prefix = ($locale && $locale !== $defaultLocale) ? "/{$locale}" : '';

        if (!$prefix) {
            return app('url')->action($name, $parameters, $absolute);
        }

        $action = app('url')->action($name, $parameters, false);

        if (str_starts_with($action, $prefix)) {
            $path = $action;
        } else {
            $path = $prefix . ($action === '/' ? '' : $action);
        }

        return ($absolute ? app('request')->root() : '') . $path;
    }
}

if (!function_exists('to')) {
    function to(string $url, $params = []): string
    {
        $locale = app()->getLocale();
        $defaultLocale = App\Domain\Config::DefaultLocale->get();

        $prefix = ($locale !== $defaultLocale) ? $locale : '';

        $route = new Illuminate\Routing\Route('', trim("{$prefix}/{$url}", '/'), '');

        return app('url')->toRoute($route, $params, false);
    }
}

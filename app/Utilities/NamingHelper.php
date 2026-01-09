<?php

namespace App\Utilities;

class NamingHelper
{
    public static function acpControllerPrefix(string $controller): string
    {
        return implode('/', array_map(function ($ary) {
            return \Str::snake($ary, '-');
        }, explode('\\', \Str::replaceLast('Controller', '', \Str::after($controller, 'Acp\\')))));
    }

    /**
     * App\PostPhoto => PostPhotos
     */
    public static function controllerName(object $class): string
    {
        return \Str::plural(class_basename($class));
    }

    // PostPhotos\FunnyEvents => post-photos.funny-events
    public static function kebab(string $classString): string
    {
        return implode('.', array_map(function ($item) {
            return \Str::kebab($item);
        }, explode('\\', $classString)));
    }

    public static function modelBasenameFromController(string $controller): string
    {
        return \Str::singular(\Str::replaceLast('Controller', '', class_basename($controller)));
    }

    public static function modelClassFromController(string $controller): string
    {
        return 'App\\' . self::modelBasenameFromController($controller);
    }

    public static function modelResourceClassFromController(string $controller): string
    {
        $model = self::modelBasenameFromController($controller);

        return "App\\Http\\Resources\\Acp\\{$model}";
    }

    public static function modelResourceCollectionClassFromController(string $controller): string
    {
        $model = self::modelBasenameFromController($controller);

        return "App\\Http\\Resources\\Acp\\{$model}Collection";
    }

    /**
     * App\PostPhoto => post-photos
     */
    public static function transField(object $class): string
    {
        return static::kebab(static::controllerName($class));
    }
}

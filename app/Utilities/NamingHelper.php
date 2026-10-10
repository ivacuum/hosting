<?php

namespace App\Utilities;

class NamingHelper
{
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
        return implode('.', array_map(static function ($item) {
            return \Str::kebab($item);
        }, explode('\\', $classString)));
    }

    /**
     * App\PostPhoto => post-photos
     */
    public static function transField(object $class): string
    {
        return static::kebab(static::controllerName($class));
    }
}

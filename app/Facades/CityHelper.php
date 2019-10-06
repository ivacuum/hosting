<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/** @noinspection PhpUndefinedClassInspection */

class CityHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Utilities\CityHelper::class;
    }
}

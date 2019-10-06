<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/** @noinspection PhpUndefinedClassInspection */

class CountryHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Utilities\CountryHelper::class;
    }
}

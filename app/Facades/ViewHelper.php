<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/** @noinspection PhpUndefinedClassInspection */

class ViewHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Utilities\ViewHelper::class;
    }
}

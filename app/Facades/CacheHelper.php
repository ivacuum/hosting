<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CacheHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Utilities\CacheHelper::class;
    }
}

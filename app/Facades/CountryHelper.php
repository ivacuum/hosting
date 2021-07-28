<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CountryHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Utilities\CountryHelper::class;
    }
}

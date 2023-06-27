<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CityHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Utilities\CityHelper::class;
    }
}

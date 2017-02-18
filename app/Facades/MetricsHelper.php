<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MetricsHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Utilities\MetricsHelper::class;
    }
}

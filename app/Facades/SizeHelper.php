<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class SizeHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Utilities\SizeHelper::class;
    }
}

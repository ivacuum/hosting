<?php namespace App\Breadcrumbs\Facades;

use Illuminate\Support\Facades\Facade;

class Breadcrumbs extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'breadcrumbs';
    }
}

<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Breadcrumbs extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\Breadcrumbs::class;
    }
}

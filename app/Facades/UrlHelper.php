<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UrlHelper extends Facade
{
    #[\Override]
    protected static function getFacadeAccessor()
    {
        return \App\Utilities\UrlHelper::class;
    }
}

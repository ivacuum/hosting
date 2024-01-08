<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ViewHelper extends Facade
{
    #[\Override]
    protected static function getFacadeAccessor()
    {
        return \App\Utilities\ViewHelper::class;
    }
}

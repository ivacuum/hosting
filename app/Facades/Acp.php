<?php

namespace App\Facades;

use App\Utilities\AcpHelper;
use Illuminate\Support\Facades\Facade;

class Acp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return AcpHelper::class;
    }
}

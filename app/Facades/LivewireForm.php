<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class LivewireForm extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Utilities\LivewireForm::class;
    }
}

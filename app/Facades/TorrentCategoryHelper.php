<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class TorrentCategoryHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Utilities\TorrentCategoryHelper::class;
    }
}

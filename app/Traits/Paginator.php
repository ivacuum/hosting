<?php namespace App\Traits;

use App\Scopes\PaginatorScope;

trait Paginator
{
    public static function bootPaginator()
    {
        static::addGlobalScope(new PaginatorScope);
    }
}

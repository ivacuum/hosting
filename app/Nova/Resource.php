<?php namespace App\Nova;

use Laravel\Nova\Resource as NovaResource;

abstract class Resource extends NovaResource
{
    public static $globallySearchable = false;
    protected static $defaultOrderBy;

    protected static function applyOrderings($query, array $orderings)
    {
        $defaultOrderBy = static::defaultOrderBy();

        if (empty($orderings) && !empty($defaultOrderBy)) {
            $orderings = $defaultOrderBy;
        }

        return parent::applyOrderings($query, $orderings);
    }

    protected static function defaultOrderBy()
    {
        return static::$defaultOrderBy;
    }
}

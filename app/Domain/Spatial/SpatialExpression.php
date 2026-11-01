<?php

namespace App\Domain\Spatial;

use Illuminate\Contracts\Database\Query\Expression;
use Illuminate\Database\Grammar;

class SpatialExpression implements Expression
{
    public function __construct(private LineString|Point|Polygon $geometry) {}

    #[\Override]
    public function getValue(Grammar $grammar): string
    {
        $wkt = $grammar->escape($this->geometry->toWkt());

        return "ST_GeomFromText({$wkt}, {$this->geometry->srid}, 'axis-order=long-lat')";
    }
}

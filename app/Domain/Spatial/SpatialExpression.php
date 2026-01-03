<?php

namespace App\Domain\Spatial;

use Illuminate\Database\Grammar;
use Illuminate\Database\Query\Expression;

class SpatialExpression extends Expression
{
    #[\Override]
    public function getValue(Grammar $grammar)
    {
        if (!$this->value instanceof GeometryInterface) {
            throw new \DomainException('Unexpected value type.');
        }

        $wkt = $grammar->escape($this->value->toWkt());

        return "ST_GeomFromText({$wkt}, {$this->value->srid}, 'axis-order=long-lat')";
    }
}

<?php namespace App;

use App\Spatial\GeometryInterface;
use Illuminate\Database\Grammar;
use Illuminate\Database\Query\Expression;

class SpatialExpression extends Expression
{
    public function getValue(Grammar $grammar)
    {
        if (!$this->value instanceof GeometryInterface) {
            throw new \DomainException('Unexpected value type.');
        }

        $wkt = \DB::connection()->getPdo()->quote($this->value->toWkt());

        return "ST_GeomFromText({$wkt}, {$this->value->srid}, 'axis-order=long-lat')";
    }
}

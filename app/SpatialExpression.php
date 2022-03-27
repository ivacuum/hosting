<?php namespace App;

use Grimzy\LaravelMysqlSpatial\Types\GeometryInterface;
use Illuminate\Database\Query\Expression;

class SpatialExpression extends Expression
{
    public function getValue()
    {
        if (!$this->value instanceof GeometryInterface) {
            throw new \DomainException('Unexpected value type.');
        }
        
        $wkt = \DB::connection()->getPdo()->quote($this->value->toWKT());

        return "ST_GeomFromText({$wkt}, {$this->value->getSrid()}, 'axis-order=long-lat')";
    }
}

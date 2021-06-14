<?php namespace App;

use Illuminate\Database\Query\Expression;

class SpatialExpression extends Expression
{
    public function getValue()
    {
        $wkt = \DB::connection()->getPdo()->quote($this->value->toWKT());

        return "ST_GeomFromText({$wkt}, {$this->value->getSrid()}, 'axis-order=long-lat')";
    }
}

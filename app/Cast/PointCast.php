<?php namespace App\Cast;

use App\SpatialExpression;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PointCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_string($value) && strlen($value) >= 13) {
            return Point::fromWKB($value);
        }

        return $value;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return new SpatialExpression($value);
    }
}

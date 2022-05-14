<?php namespace App\Cast;

use App\Spatial\Point;
use App\SpatialExpression;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PointCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_string($value) && strlen($value) >= 13) {
            return Point::fromWkb($value);
        }

        return $value;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if ($value === null) {
            return null;
        }

        return new SpatialExpression($value);
    }
}

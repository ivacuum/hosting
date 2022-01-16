<?php namespace App\Cast;

use App\Domain\TripStatus;
use App\Trip;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class StatusCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        if ($model instanceof Trip) {
            return new TripStatus($value);
        }

        return $value;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if ($model instanceof Trip) {
            if ($value instanceof TripStatus) {
                return $value->jsonSerialize();
            }

            return (new TripStatus($value))->jsonSerialize();
        }

        return $value;
    }
}

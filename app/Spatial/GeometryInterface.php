<?php

namespace App\Spatial;

interface GeometryInterface
{
    public function __toString(): string;

    public static function fromString(string $wktArgument, int $srid = 4326);

    public static function fromWkt(string $wkt, int $srid = 4326);

    public function toWkt(): string;
}

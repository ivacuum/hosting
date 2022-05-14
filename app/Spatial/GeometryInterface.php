<?php namespace App\Spatial;

interface GeometryInterface
{
    public static function fromString(string $wktArgument, int $srid = 0);

    public static function fromWkt(string $wkt, int $srid = 0);

    public function toWkt(): string;

    public function __toString(): string;
}

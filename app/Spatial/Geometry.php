<?php

namespace App\Spatial;

use GeoIO\WKB\Parser\Parser;
use Illuminate\Contracts\Support\Jsonable;

abstract class Geometry implements \JsonSerializable, GeometryInterface, Jsonable
{
    public static function fromWkb($wkb): self
    {
        // MySQL stores geometry values using 4 bytes to indicate
        // the SRID followed by the WKB representation of the value
        $srid = substr($wkb, 0, 4);
        $srid = unpack('L', $srid)[1];

        $wkb = substr($wkb, 4);
        $parser = new Parser(new Factory($srid));

        return $parser->parse($wkb);
    }

    public static function fromWkt(string $wkt, int $srid = 4326)
    {
        $wktArgument = static::getWktArgument($wkt);

        return static::fromString($wktArgument, $srid);
    }

    public static function getWktArgument($value)
    {
        $left = strpos($value, '(');
        $right = strrpos($value, ')');

        return substr($value, $left + 1, $right - $left - 1);
    }

    public function toJson($options = 0)
    {
        return json_encode($this, $options);
    }
}

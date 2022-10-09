<?php namespace App\Spatial;

class Factory implements \GeoIO\Factory
{
    public function __construct(private int $srid = 4326)
    {
    }

    public function createGeometryCollection($dimension, array $geometries, $srid = null)
    {
        throw new \RuntimeException('Not supported.');
    }

    public function createLinearRing($dimension, array $points, $srid = null)
    {
        return new LineString($this->srid, ...$points);
    }

    public function createLineString($dimension, array $points, $srid = null)
    {
        throw new \RuntimeException('Not supported.');
    }

    public function createMultiLineString($dimension, array $lineStrings, $srid = null)
    {
        throw new \RuntimeException('Not supported.');
    }

    public function createMultiPoint($dimension, array $points, $srid = null)
    {
        throw new \RuntimeException('Not supported.');
    }

    public function createMultiPolygon($dimension, array $polygons, $srid = null)
    {
        throw new \RuntimeException('Not supported.');
    }

    public function createPoint($dimension, array $coordinates, $srid = null)
    {
        return new Point($coordinates['y'], $coordinates['x'], $this->srid);
    }

    public function createPolygon($dimension, array $lineStrings, $srid = null)
    {
        return new Polygon($this->srid, ...$lineStrings);
    }
}

<?php namespace App\Spatial;

class Point extends Geometry implements \Stringable
{
    public function __construct(
        public readonly string $lat,
        public readonly string $lon,
        public readonly int $srid = 4326
    ) {
    }

    public static function fromPair(string $pair, int $srid = 4326)
    {
        [$lon, $lat] = explode(' ', trim($pair, "\t\n\r \x0B()"));

        return new static($lat, $lon, $srid);
    }

    public static function fromString(string $wktArgument, int $srid = 4326)
    {
        return static::fromPair($wktArgument, $srid);
    }

    public function jsonSerialize()
    {
        return [
            'coordinates' => [$this->lat, $this->lon],
        ];
    }

    public function toPair(): string
    {
        return "{$this->lon} {$this->lat}";
    }

    public function toWkt(): string
    {
        return sprintf('POINT(%s)', $this->__toString());
    }

    public function __toString(): string
    {
        return "{$this->lon} {$this->lat}";
    }
}

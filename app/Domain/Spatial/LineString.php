<?php

namespace App\Domain\Spatial;

class LineString extends Geometry implements \Stringable
{
    /** @var array<Point> */
    public array $items;

    public function __construct(
        public readonly int $srid = 4326,
        Point ...$items,
    ) {
        $this->items = $items;
    }

    #[\Override]
    public function __toString(): string
    {
        return $this->toPairList();
    }

    #[\Override]
    public static function fromString(string $wktArgument, int $srid = 4326)
    {
        $pairs = explode(',', trim($wktArgument));
        $points = array_map(fn ($pair) => Point::fromPair($pair), $pairs);

        return new static($srid, ...$points);
    }

    #[\Override]
    public function jsonSerialize(): array
    {
        return [
            'coordinates' => collect($this->items)
                ->map(fn (Point $point) => $point->jsonSerialize()['coordinates'])
                ->all(),
        ];
    }

    public function toPairList(): string
    {
        return implode(',', array_map(fn (Point $point) => $point->toPair(), $this->items));
    }

    #[\Override]
    public function toWkt(): string
    {
        return sprintf('LINESTRING(%s)', $this->__toString());
    }
}

<?php

namespace App\Spatial;

class Polygon extends Geometry implements \Stringable
{
    /** @var array<LineString> */
    public array $items;

    public function __construct(public readonly int $srid = 4326, LineString ...$items)
    {
        $this->items = $items;
    }

    #[\Override]
    public function __toString(): string
    {
        return implode(
            ',',
            array_map(fn (LineString $lineString) => sprintf('(%s)', $lineString->__toString()), $this->items)
        );
    }

    #[\Override]
    public static function fromString(string $wktArgument, int $srid = 4326)
    {
        $str = preg_split('/\)\s*,\s*\(/', substr(trim($wktArgument), 1, -1));
        $lineStrings = array_map(fn ($geometry) => LineString::fromString($geometry), $str);

        return new static($srid, ...$lineStrings);
    }

    #[\Override]
    public function jsonSerialize(): array
    {
        return [
            'type' => 'Polygon',
            'coordinates' => collect($this->items)
                ->map(fn (LineString $lineString) => $lineString->jsonSerialize()['coordinates'])
                ->all(),
        ];
    }

    #[\Override]
    public function toWkt(): string
    {
        return sprintf('POLYGON(%s)', $this->__toString());
    }
}

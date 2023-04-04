<?php namespace App\Spatial;

class Polygon extends Geometry implements \Stringable
{
    /** @var array<LineString> */
    public array $items;

    public function __construct(public readonly int $srid = 4326, LineString ...$items)
    {
        $this->items = $items;
    }

    public static function fromString(string $wktArgument, int $srid = 4326)
    {
        $str = preg_split('/\)\s*,\s*\(/', substr(trim($wktArgument), 1, -1));
        $lineStrings = array_map(fn ($geometry) => LineString::fromString($geometry), $str);

        return new static($srid, ...$lineStrings);
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => 'Polygon',
            'coordinates' => collect($this->items)
                ->map(fn (LineString $lineString) => $lineString->jsonSerialize()['coordinates'])
                ->all(),
        ];
    }

    public function toWkt(): string
    {
        return sprintf('POLYGON(%s)', $this->__toString());
    }

    public function __toString(): string
    {
        return implode(
            ',',
            array_map(fn (LineString $lineString) => sprintf('(%s)', $lineString->__toString()), $this->items)
        );
    }
}

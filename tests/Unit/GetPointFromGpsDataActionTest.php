<?php

namespace Tests\Unit;

use App\Domain\Exif\GetPointFromGpsDataAction;
use Illuminate\Foundation\Testing\Attributes\UnitTest;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class GetPointFromGpsDataActionTest extends TestCase
{
    #[UnitTest]
    public function testEmpty(): void
    {
        $point = new GetPointFromGpsDataAction()->execute([]);

        $this->assertNull($point);
    }

    #[UnitTest]
    #[TestWith(['N', 'E', '53.029506', '129.720122'], 'north east')]
    #[TestWith(['S', 'E', '-53.029506', '129.720122'], 'south east')]
    #[TestWith(['N', 'W', '53.029506', '-129.720122'], 'north west')]
    public function testHemisphereCoordinates(string $latitudeRef, string $longitudeRef, string $latitude, string $longitude): void
    {
        $point = new GetPointFromGpsDataAction()
            ->execute([
                'GPSLatitudeRef' => $latitudeRef,
                'GPSLatitude' => [
                    '53/1',
                    '1/1',
                    '4622/100',
                ],
                'GPSLongitudeRef' => $longitudeRef,
                'GPSLongitude' => [
                    '129/1',
                    '43/1',
                    '1244/100',
                ],
            ]);

        $this->assertSame($latitude, $point->lat);
        $this->assertSame($longitude, $point->lon);
    }

    #[UnitTest]
    #[TestWith([['53/1', '1/1', '0/0']])]
    #[TestWith([['53/1', '1/1']])]
    public function testInvalidCoordinatesHaveNoLocation(array $coordinates): void
    {
        $point = new GetPointFromGpsDataAction()->execute([
            'GPSLatitudeRef' => 'N',
            'GPSLatitude' => $coordinates,
            'GPSLongitudeRef' => 'E',
            'GPSLongitude' => ['129/1', '43/1', '1244/100'],
        ]);

        $this->assertNull($point);
    }
}

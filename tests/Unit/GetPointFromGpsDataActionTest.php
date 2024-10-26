<?php

namespace Tests\Unit;

use App\Domain\Exif\GetPointFromGpsDataAction;
use Tests\TestCase;

class GetPointFromGpsDataActionTest extends TestCase
{
    public function testEmpty()
    {
        $point = app(GetPointFromGpsDataAction::class)
            ->execute([]);

        $this->assertNull($point);
    }

    public function testOk()
    {
        $point = app(GetPointFromGpsDataAction::class)
            ->execute([
                'GPSLatitudeRef' => 'N',
                'GPSLatitude' => [
                    '53/1',
                    '1/1',
                    '4622/100',
                ],
                'GPSLongitudeRef' => 'E',
                'GPSLongitude' => [
                    '129/1',
                    '43/1',
                    '1244/100',
                ],
            ]);

        $this->assertSame('53.029506', $point->lat);
        $this->assertSame('129.720122', $point->lon);
    }

    public function testSouth()
    {
        $point = app(GetPointFromGpsDataAction::class)
            ->execute([
                'GPSLatitudeRef' => 'S',
                'GPSLatitude' => [
                    '53/1',
                    '1/1',
                    '4622/100',
                ],
                'GPSLongitudeRef' => 'E',
                'GPSLongitude' => [
                    '129/1',
                    '43/1',
                    '1244/100',
                ],
            ]);

        $this->assertSame('-53.029506', $point->lat);
        $this->assertSame('129.720122', $point->lon);
    }

    public function testWest()
    {
        $point = app(GetPointFromGpsDataAction::class)
            ->execute([
                'GPSLatitudeRef' => 'N',
                'GPSLatitude' => [
                    '53/1',
                    '1/1',
                    '4622/100',
                ],
                'GPSLongitudeRef' => 'W',
                'GPSLongitude' => [
                    '129/1',
                    '43/1',
                    '1244/100',
                ],
            ]);

        $this->assertSame('53.029506', $point->lat);
        $this->assertSame('-129.720122', $point->lon);
    }
}

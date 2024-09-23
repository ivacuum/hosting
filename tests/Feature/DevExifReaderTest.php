<?php

namespace Tests\Feature;

use App\Domain\Exif\ReadRawExifDataAction;
use App\Livewire\ExifReader;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class DevExifReaderTest extends TestCase
{
    use DatabaseTransactions;

    public function testEmpty()
    {
        $this->get('dev/exif-reader')
            ->assertOk()
            ->assertSeeLivewire(ExifReader::class);
    }

    public function testBinaryDataInUndefinedTagIsStriped()
    {
        \Storage::fake('tmp-for-tests');

        $this->mock(ReadRawExifDataAction::class)
            ->expects('execute')
            ->andReturn([
                'UndefinedTag:0xEA1C' => hex2bin('1cea0000000800'),
            ]);

        $image = UploadedFile::fake()->image('exif.jpg');

        \Livewire::test(ExifReader::class)
            ->set('image', $image)
            ->call('submit')
            ->assertSet('data', []);
    }

    public function testDivisionByZeroPreventedForNullifiedGpsData()
    {
        \Storage::fake('tmp-for-tests');

        $this->mock(ReadRawExifDataAction::class)
            ->expects('execute')
            ->andReturn([
                'GPSAltitude' => '0/0',
                'GPSAltitudeRef' => chr(0),
            ]);

        $image = UploadedFile::fake()->image('exif.jpg');

        \Livewire::test(ExifReader::class)
            ->set('image', $image)
            ->call('submit')
            ->assertSet('data', [
                'GPSAltitude' => '0/0',
                'GPSAltitudeRef' => chr(0),
            ]);
    }

    public function testInvalidDateTime()
    {
        \Storage::fake('tmp-for-tests');

        $this->mock(ReadRawExifDataAction::class)
            ->expects('execute')
            ->andReturn([
                'DateTime' => '2024:08:52 17:22:91',
            ]);

        $image = UploadedFile::fake()->image('exif.jpg');

        \Livewire::test(ExifReader::class)
            ->set('image', $image)
            ->call('submit')
            ->assertSet('date', CarbonImmutable::make('2024-09-21 17:23:31'));
    }
}

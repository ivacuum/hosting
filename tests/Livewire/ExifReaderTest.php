<?php

namespace Tests\Livewire;

use App\Domain\Exif\Jobs\DeleteTempLivewireFileJob;
use App\Domain\Exif\Livewire\ExifReader;
use App\Domain\Exif\ReadRawExifDataAction;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Livewire\Features\SupportFileUploads\FileUploadConfiguration;
use Tests\TestCase;

class ExifReaderTest extends TestCase
{
    use DatabaseTransactions;

    public function testBinaryDataInUndefinedTagIsStriped()
    {
        \Queue::fake([DeleteTempLivewireFileJob::class]);
        \Storage::fake(FileUploadConfiguration::disk());

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

    public function testDeletedImageHandled()
    {
        \Queue::fake([DeleteTempLivewireFileJob::class]);
        \Storage::fake(FileUploadConfiguration::disk());

        $image = UploadedFile::fake()->image('exif.jpg');

        $component = \Livewire::test(ExifReader::class)
            ->set('image', $image);

        \Storage::disk(FileUploadConfiguration::disk())
            ->deleteDirectory(FileUploadConfiguration::directory());

        $component->call('submit')
            ->assertSet('size', 0)
            ->assertSet('width', 0)
            ->assertSet('height', 0)
            ->assertSet('image', null)
            ->assertSet('date', null)
            ->assertSet('read', false)
            ->assertSet('data', [])
            ->assertHasErrors(['image' => 'Файл уже удален с сервера. Загрузите его, пожалуйста, еще раз.']);
    }

    public function testDivisionByZeroPreventedForNullifiedGpsData(): void
    {
        \Queue::fake([DeleteTempLivewireFileJob::class]);
        \Storage::fake(FileUploadConfiguration::disk());

        $data = [
            'Model' => 'Camera with unavailable GPS',
            'GPSAltitude' => '0/0',
            'GPSAltitudeRef' => chr(0),
            'GPSLatitudeRef' => 'N',
            'GPSLatitude' => ['0/0', '0/0', '0/0'],
            'GPSLongitudeRef' => 'E',
            'GPSLongitude' => ['0/0', '0/0', '0/0'],
        ];

        $this->mock(ReadRawExifDataAction::class)
            ->expects('execute')
            ->andReturn($data);

        $image = UploadedFile::fake()->image('exif.jpg');

        \Livewire::test(ExifReader::class)
            ->set('image', $image)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('lat', null)
            ->assertSet('lon', null)
            ->assertSet('data', $data);
    }

    public function testImageDeleteJobQueued()
    {
        \Queue::fake();
        \Storage::fake(FileUploadConfiguration::disk());

        $image = UploadedFile::fake()->image('IMG_0025.jpeg');

        \Livewire::test(ExifReader::class)
            ->set('image', $image);

        \Queue::assertPushed(DeleteTempLivewireFileJob::class);
    }

    public function testInvalidDateTime()
    {
        \Queue::fake([DeleteTempLivewireFileJob::class]);
        \Storage::fake(FileUploadConfiguration::disk());

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

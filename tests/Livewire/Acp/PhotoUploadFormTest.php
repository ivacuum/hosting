<?php

namespace Tests\Livewire\Acp;

use App\Domain\Exif\ReadRawExifDataAction;
use App\Domain\Life\Factory\GigFactory;
use App\Domain\Life\Factory\PhotoFactory;
use App\Domain\Life\Factory\TripFactory;
use App\Factory\UserFactory;
use App\Livewire\Acp\PhotoUploadForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Livewire\Features\SupportFileUploads\FileUploadConfiguration;
use Tests\TestCase;

class PhotoUploadFormTest extends TestCase
{
    use DatabaseTransactions;

    public function testDoesNotOverwriteImage(): void
    {
        \Storage::fake('photos');
        \Storage::fake(FileUploadConfiguration::disk());

        $file = UploadedFile::fake()->image('IMG_0013.jpeg');

        $trip = TripFactory::new()
            ->withSlug('our-phpunit-trip')
            ->create();

        $user = UserFactory::new()->root()->create();

        $photo = PhotoFactory::new()
            ->withTrip($trip)
            ->withUser($user)
            ->withSlug('our-phpunit-trip/IMG_0013.jpg')
            ->create();

        \Storage::disk('photos')->put($photo->slug, 'original image');

        \Livewire::actingAs($user)
            ->test(PhotoUploadForm::class)
            ->set('tripId', $trip->id)
            ->set('file', $file);

        $trip->refresh();
        $uploadedPhoto = $trip->photos->sole();

        $this->assertTrue($uploadedPhoto->is($photo));
        $this->assertSame('our-phpunit-trip/IMG_0013.jpg', $uploadedPhoto->slug);

        $this->assertSame('original image', \Storage::disk('photos')->get($photo->slug));
    }

    public function testGigPhoto(): void
    {
        \Storage::fake('photos');
        \Storage::fake(FileUploadConfiguration::disk());

        $gig = GigFactory::new()->withSlug('phpunit-gig')->create();
        $file = UploadedFile::fake()->image('IMG_0025.jpeg');
        $user = UserFactory::new()->root()->create();

        \Livewire::actingAs($user)
            ->test(PhotoUploadForm::class)
            ->set('gigId', $gig->id)
            ->set('file', $file);

        $this->assertSame('phpunit-gig/IMG_0025.jpg', $gig->photos->sole()->slug);

        \Storage::disk('photos')->assertExists('gigs/phpunit-gig/IMG_0025.jpg');
    }

    public function testPngToJpeg(): void
    {
        \Storage::fake('photos');
        \Storage::fake(FileUploadConfiguration::disk());

        $gig = GigFactory::new()->withSlug('phpunit-gig')->create();
        $file = UploadedFile::fake()->image('IMG_1234.png');
        $user = UserFactory::new()->root()->create();

        \Livewire::actingAs($user)
            ->test(PhotoUploadForm::class)
            ->set('gigId', $gig->id)
            ->set('file', $file);

        $photo = $gig->photos->sole();

        $this->assertSame('phpunit-gig/IMG_1234.jpg', $photo->slug);
        $this->assertNull($photo->point);

        \Storage::disk('photos')->assertExists('gigs/phpunit-gig/IMG_1234.jpg');
    }

    public function testProcessingFailureIsRecordedAndDoesNotPreventTheNextFile(): void
    {
        \Storage::fake('photos');
        \Storage::fake(FileUploadConfiguration::disk());

        $brokenFile = UploadedFile::fake()->image('broken.jpg');
        $validFile = UploadedFile::fake()->image('valid.jpg');
        $trip = TripFactory::new()->withSlug('phpunit-trip')->create();
        $user = UserFactory::new()->root()->create();
        $readExif = $this->mock(ReadRawExifDataAction::class);
        $readExif->expects('execute')->ordered()->andThrow(new \RuntimeException('Не удалось прочитать EXIF.'));
        $readExif->expects('execute')->ordered()->andReturn([]);

        \Livewire::actingAs($user)
            ->test(PhotoUploadForm::class)
            ->set('tripId', $trip->id)
            ->call('queueFiles', ['broken.jpg', 'valid.jpg'])
            ->set('file', $brokenFile)
            ->set('file', $validFile)
            ->assertSet('processed', 2)
            ->assertSet('uploaded', 1)
            ->assertSet('uploadResults.0', [
                'filename' => 'broken.jpg',
                'message' => 'Не удалось прочитать EXIF.',
                'status' => 'error',
            ])
            ->assertSet('uploadResults.1', [
                'filename' => 'valid.jpg',
                'message' => 'phpunit-trip/valid.jpg',
                'status' => 'success',
            ])
            ->assertSee('broken.jpg')
            ->assertSee('Не удалось прочитать EXIF.')
            ->assertSee('valid.jpg');

        \Storage::disk('photos')->assertMissing('phpunit-trip/broken.jpg');
        \Storage::disk('photos')->assertExists('phpunit-trip/valid.jpg');
    }

    public function testReplaceTripPhoto(): void
    {
        \Storage::fake('photos');
        \Storage::fake(FileUploadConfiguration::disk());

        $file = UploadedFile::fake()->image('IMG_0013.jpeg');

        $trip = TripFactory::new()
            ->withSlug('our-phpunit-trip')
            ->create();

        $user = UserFactory::new()->root()->create();

        $photo = PhotoFactory::new()
            ->withTrip($trip)
            ->withUser($user)
            ->withSlug('our-phpunit-trip/IMG_0013.jpg')
            ->create();

        \Storage::disk('photos')->put($photo->slug, 'original image');

        \Livewire::actingAs($user)
            ->test(PhotoUploadForm::class)
            ->set('tripId', $trip->id)
            ->set('shouldOverwriteImage', true)
            ->set('file', $file);

        $trip->refresh();
        $uploadedPhoto = $trip->photos->sole();

        $this->assertTrue($uploadedPhoto->is($photo));
        $this->assertSame('our-phpunit-trip/IMG_0013.jpg', $uploadedPhoto->slug);

        \Storage::disk('photos')->assertExists('our-phpunit-trip/IMG_0013.jpg');
        $this->assertNotSame('original image', \Storage::disk('photos')->get($photo->slug));
    }

    public function testTemporaryUploadFailureIsRecordedFromTheLivewireErrorBag(): void
    {
        $user = UserFactory::new()->root()->create();
        $errors = json_encode([
            'errors' => [
                'files.0' => ['Размер файла должен быть не более 20480 КБ.'],
            ],
        ], JSON_THROW_ON_ERROR);

        \Livewire::actingAs($user)
            ->test(PhotoUploadForm::class)
            ->call('queueFiles', ['too-large.jpg'])
            ->call('_uploadErrored', 'file', $errors, false)
            ->assertHasErrors('file')
            ->call('uploadFailed', 'too-large.jpg')
            ->assertHasNoErrors('file')
            ->assertSet('processed', 1)
            ->assertSet('uploaded', 0)
            ->assertSet('uploadResults.0', [
                'filename' => 'too-large.jpg',
                'message' => 'Размер файла должен быть не более 20480 КБ.',
                'status' => 'error',
            ]);
    }

    public function testTripPhoto(): void
    {
        \Storage::fake('photos');
        \Storage::fake(FileUploadConfiguration::disk());

        $file = UploadedFile::fake()->image('IMG_0011.jpeg');
        $user = UserFactory::new()->root()->create();
        $trip = TripFactory::new()->withSlug('phpunit-trip')->withUser($user)->create();

        \Livewire::actingAs($user)
            ->test(PhotoUploadForm::class)
            ->set('tripId', $trip->id)
            ->call('queueFiles', ['IMG_0011.jpeg'])
            ->set('file', $file)
            ->assertSet('processed', 1)
            ->assertSet('uploaded', 1)
            ->assertSet('uploadResults.0', [
                'filename' => 'IMG_0011.jpeg',
                'message' => 'phpunit-trip/IMG_0011.jpg',
                'status' => 'success',
            ]);

        $trip->refresh();
        $this->assertSame('phpunit-trip/IMG_0011.jpg', $trip->photos->sole()->slug);

        \Storage::disk('photos')->assertExists('phpunit-trip/IMG_0011.jpg');
    }
}

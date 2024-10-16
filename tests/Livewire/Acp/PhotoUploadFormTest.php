<?php

namespace Tests\Livewire\Acp;

use App\Factory\GigFactory;
use App\Factory\PhotoFactory;
use App\Factory\TripFactory;
use App\Factory\UserFactory;
use App\Livewire\Acp\PhotoUploadForm;
use App\Photo;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Livewire\Features\SupportFileUploads\FileUploadConfiguration;
use Tests\TestCase;

class PhotoUploadFormTest extends TestCase
{
    use DatabaseTransactions;

    public function testGigPhoto()
    {
        \Storage::fake('photos');
        \Storage::fake(FileUploadConfiguration::disk());

        $gig = GigFactory::new()->create();
        $file = UploadedFile::fake()->image('IMG_0025.jpeg');
        $user = UserFactory::new()->admin()->make();

        \Livewire::actingAs($user)
            ->test(PhotoUploadForm::class)
            ->set('gigId', $gig->id)
            ->set('file', $file);

        $photo = Photo::query()->firstWhere([
            'rel_type' => $gig->getMorphClass(),
            'rel_id' => $gig->id,
        ]);

        $this->assertNotNull($photo);

        \Storage::disk('photos')->assertExists("gigs/{$photo->slug}");
    }

    public function testReplaceTripPhoto()
    {
        \Storage::fake('photos');
        \Storage::fake(FileUploadConfiguration::disk());

        $file = UploadedFile::fake()->image('IMG_0013.jpeg');

        $trip = TripFactory::new()
            ->withSlug('our-phpunit-trip')
            ->create();

        $photo = PhotoFactory::new()
            ->withTripId($trip->id)
            ->withSlug('our-phpunit-trip/IMG_0013.jpg')
            ->create();

        $user = UserFactory::new()->admin()->make();

        \Livewire::actingAs($user)
            ->test(PhotoUploadForm::class)
            ->set('tripId', $trip->id)
            ->set('file', $file);

        $uploadedPhoto = Photo::query()->firstWhere([
            'rel_type' => $trip->getMorphClass(),
            'rel_id' => $trip->id,
        ]);

        $this->assertNotNull($uploadedPhoto);
        $this->assertTrue($uploadedPhoto->is($photo));
        $this->assertStringEndsWith('.jpg', $uploadedPhoto->slug);

        \Storage::disk('photos')->assertExists($uploadedPhoto->slug);
    }

    public function testTripPhoto()
    {
        \Storage::fake('photos');
        \Storage::fake(FileUploadConfiguration::disk());

        $file = UploadedFile::fake()->image('IMG_0011.jpeg');
        $trip = TripFactory::new()->create();
        $user = UserFactory::new()->admin()->make();

        \Livewire::actingAs($user)
            ->test(PhotoUploadForm::class)
            ->set('tripId', $trip->id)
            ->set('file', $file);

        $photo = Photo::query()->firstWhere([
            'rel_type' => $trip->getMorphClass(),
            'rel_id' => $trip->id,
        ]);

        $this->assertNotNull($photo);
        $this->assertStringEndsWith('.jpg', $photo->slug);

        \Storage::disk('photos')->assertExists($photo->slug);
    }
}

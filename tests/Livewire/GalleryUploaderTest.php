<?php

namespace Tests\Livewire;

use App\Factory\UserFactory;
use App\Http\Livewire\GalleryUploader;
use App\Image;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class GalleryUploaderTest extends TestCase
{
    use DatabaseTransactions;

    public function testStore()
    {
        \Storage::fake('gallery');
        \Storage::fake('tmp-for-tests');

        $file = UploadedFile::fake()->image('screenshot.png');
        $user = UserFactory::new()->create();

        \Event::fake(\App\Events\Stats\GalleryImageUploaded::class);

        \Livewire::actingAs($user)
            ->test(GalleryUploader::class)
            ->set('files', [$file]);

        $image = Image::firstWhere(['user_id' => $user->id]);

        \Event::assertDispatched(\App\Events\Stats\GalleryImageUploaded::class);
        \Storage::disk('gallery')->assertExists("{$image->splittedDate()}/{$image->slug}");
        \Storage::disk('gallery')->assertExists("{$image->splittedDate()}/t/{$image->slug}");
    }
}

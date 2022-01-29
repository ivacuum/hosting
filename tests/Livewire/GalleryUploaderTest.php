<?php namespace Tests\Livewire;

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

        $file = UploadedFile::fake()->image('screenshot.png');
        $user = UserFactory::new()->create();

        $this->expectsEvents(\App\Events\Stats\GalleryImageUploaded::class);

        \Livewire::actingAs($user)
            ->test(GalleryUploader::class)
            ->set('files', [$file]);

        $image = Image::firstWhere(['user_id' => $user->id]);

        \Storage::disk('gallery')->assertExists("{$image->splittedDate()}/{$image->slug}");
        \Storage::disk('gallery')->assertExists("{$image->splittedDate()}/t/{$image->slug}");
    }
}

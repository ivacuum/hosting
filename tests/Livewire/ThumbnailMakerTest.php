<?php

namespace Tests\Livewire;

use App\Factory\UserFactory;
use App\Livewire\ThumbnailMaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Livewire\Features\SupportFileUploads\FileUploadConfiguration;
use Tests\TestCase;

class ThumbnailMakerTest extends TestCase
{
    use DatabaseTransactions;

    public function testPngThumbnailIsStoredAsJpeg(): void
    {
        \Storage::fake('temp');
        \Storage::fake(FileUploadConfiguration::disk());

        $user = UserFactory::new()->root()->create();
        $file = UploadedFile::fake()->image('thumbnail.png');

        \Livewire::actingAs($user)
            ->test(ThumbnailMaker::class)
            ->set('file', $file)
            ->assertHasNoErrors()
            ->assertSet('thumbnails', ['thumbnail.jpg'])
            ->assertSet('uploaded', 1);

        \Storage::disk('temp')->assertExists('thumbnail.jpg');

        $this->assertSame('image/jpeg', \Storage::disk('temp')->mimeType('thumbnail.jpg'));
    }
}

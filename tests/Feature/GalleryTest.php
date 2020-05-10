<?php namespace Tests\Feature;

use App\Factory\ImageFactory;
use App\Factory\UserFactory;
use App\Image;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class GalleryTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $image = ImageFactory::new()->create();

        $this->be($image->user)
            ->get('gallery')
            ->assertStatus(200);
    }

    public function testPreview()
    {
        $image = ImageFactory::new()->create();

        $this->get("gallery/preview/{$image->id}")
            ->assertStatus(200);
    }

    public function testStore()
    {
        \Storage::fake('gallery');

        $file = UploadedFile::fake()->image('screenshot.png');
        $user = UserFactory::new()->create();

        $this->expectsEvents(\App\Events\Stats\GalleryImageUploaded::class);

        $id = $this->be($user)
            ->postJson('gallery/upload', ['file' => $file])
            ->assertStatus(200)
            ->assertJson(['status' => 'OK'])
            ->json('id');

        /** @var Image $image */
        $image = Image::findOrFail($id);

        \Storage::disk('gallery')->assertExists("{$image->splittedDate()}/{$image->slug}");
        \Storage::disk('gallery')->assertExists("{$image->splittedDate()}/t/{$image->slug}");
    }

    public function testUploadPage()
    {
        $this->be(UserFactory::new()->create())
            ->get('gallery/upload')
            ->assertStatus(200);
    }

    public function testView()
    {
        $image = ImageFactory::new()->create();

        $this->get("gallery/view/{$image->id}")
            ->assertStatus(200);
    }
}

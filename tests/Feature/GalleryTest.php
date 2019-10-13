<?php namespace Tests\Feature;

use App\Image;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class GalleryTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->be($user = $this->user());
        $user->images()->save(factory(Image::class)->make());

        $this->get('gallery')
            ->assertStatus(200);
    }

    public function testPreview()
    {
        $user = $this->user();
        $image = $user->images()->save(factory(Image::class)->make());

        $this->get("gallery/preview/{$image->id}")
            ->assertStatus(200);
    }

    public function testStore()
    {
        \Storage::fake('gallery');

        $file = UploadedFile::fake()->image('screenshot.png');

        $this->expectsEvents(\App\Events\Stats\GalleryImageUploaded::class);

        $id = $this->be($user = $this->user())
            ->postJson('gallery/upload', ['file' => $file])
            ->assertStatus(200)
            ->assertJson(['status' => 'OK'])
            ->json('id');

        /** @var Image $image */
        $image = Image::findOrFail($id);

        \Storage::disk('gallery')->assertExists("{$image->splitted_date}/{$image->slug}");
        \Storage::disk('gallery')->assertExists("{$image->splitted_date}/t/{$image->slug}");
    }

    public function testUploadPage()
    {
        $this->be($this->user())
            ->get('gallery/upload')
            ->assertStatus(200);
    }

    public function testView()
    {
        $user = $this->user();
        $image = $user->images()->save(factory(Image::class)->make());

        $this->get("gallery/view/{$image->id}")
            ->assertStatus(200);
    }

    private function user(): User
    {
        return factory(User::class)->create();
    }
}

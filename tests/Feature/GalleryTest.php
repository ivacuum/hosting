<?php namespace Tests\Feature;

use App\Http\Controllers\Gallery;
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
        /** @var User $user */
        $this->be($user = factory(User::class)->create());

        $user->images()->save(factory(Image::class)->make());

        $this->get(action([Gallery::class, 'index']))
            ->assertStatus(200);
    }

    public function testPreview()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $image = $user->images()->save(factory(Image::class)->make());

        $this->get(action([Gallery::class, 'preview'], $image))
            ->assertStatus(200);
    }

    public function testStore()
    {
        \Storage::fake('gallery');

        $file = UploadedFile::fake()->image('screenshot.png');

        /** @var User $user */
        $this->be($user = factory(User::class)->create());

        $this->expectsEvents(\App\Events\Stats\GalleryImageUploaded::class);

        $id = $this->postJson(action([Gallery::class, 'upload']), ['file' => $file])
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
        $this->be(factory(User::class)->create())
            ->get(action([Gallery::class, 'upload']))
            ->assertStatus(200);
    }

    public function testView()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $image = $user->images()->save(factory(Image::class)->make());

        $this->get(action([Gallery::class, 'view'], $image))
            ->assertStatus(200);
    }
}

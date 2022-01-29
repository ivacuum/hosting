<?php namespace Tests\Feature;

use App\Factory\ImageFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
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

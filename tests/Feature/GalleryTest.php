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
            ->assertOk();
    }

    public function testPreview()
    {
        $image = ImageFactory::new()->create();

        $this->get("gallery/preview/{$image->id}")
            ->assertOk();
    }

    public function testUploadPage()
    {
        $this->be(UserFactory::new()->create())
            ->get('gallery/upload')
            ->assertOk();
    }

    public function testView()
    {
        $image = ImageFactory::new()->create();

        $this->get("gallery/view/{$image->id}")
            ->assertOk();
    }
}

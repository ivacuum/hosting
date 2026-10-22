<?php

namespace Tests\Feature;

use App\Factory\ImageFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GalleryTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex(): void
    {
        $image = ImageFactory::new()->create();

        $this->be($image->user)
            ->get('gallery')
            ->assertOk();
    }

    public function testPreview(): void
    {
        $image = ImageFactory::new()->create();

        $this->get("gallery/preview/{$image->id}")
            ->assertOk();
    }

    public function testUploadPage(): void
    {
        $this->be(UserFactory::new()->create())
            ->get('gallery/upload')
            ->assertOk();
    }

    public function testView(): void
    {
        $image = ImageFactory::new()->create();

        $this->get("gallery/view/{$image->id}")
            ->assertOk();
    }
}

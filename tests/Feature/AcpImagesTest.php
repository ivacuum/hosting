<?php

namespace Tests\Feature;

use App\Factory\ImageFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpImagesTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testIndex()
    {
        ImageFactory::new()->create();

        $this->get('acp/images')
            ->assertOk();
    }

    public function testShow()
    {
        $image = ImageFactory::new()->create();

        $this->get("acp/images/{$image->id}")
            ->assertOk();
    }
}

<?php namespace Tests\Feature;

use App\Factory\ImageFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpImagesTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

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

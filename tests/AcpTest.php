<?php namespace Tests;

use App\Factory\UserFactory;

class AcpTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

    public function testRoot()
    {
        $this->get('acp')->assertOk();
    }

    public function testPageDev()
    {
        $this->get('acp/dev')->assertOk();
    }

    public function testPageDevSvg()
    {
        $this->get('acp/dev/svg')->assertOk();
    }

    public function testPageDevThumbnails()
    {
        $this->get('acp/dev/thumbnails')->assertOk();
    }
}

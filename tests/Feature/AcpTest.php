<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

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

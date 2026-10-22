<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testClean(): void
    {
        \Storage::fake('temp');
        \Storage::disk('temp')->put('thumbnail.jpg', 'test image');

        $this
            ->delete('acp/dev/thumbnails/clean')
            ->assertRedirect('acp/dev/thumbnails');

        \Storage::disk('temp')->assertMissing('thumbnail.jpg');
    }

    public function testRoot(): void
    {
        $this->get('acp')->assertOk();
    }

    public function testPageDev(): void
    {
        $this->get('acp/dev')->assertRedirect('/acp/dev/templates');
    }

    public function testPageDevSvg(): void
    {
        $this->get('acp/dev/svg')->assertOk();
    }

    public function testPageDevThumbnails(): void
    {
        $this->get('acp/dev/thumbnails')->assertOk();
    }
}

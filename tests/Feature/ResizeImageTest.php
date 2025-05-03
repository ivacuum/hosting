<?php

namespace Tests\Feature;

use App\Action\GetResizeImageWhitelistAction;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Ivacuum\Generic\Services\ImageConverter;
use Tests\TestCase;

class ResizeImageTest extends TestCase
{
    use DatabaseTransactions;

    public function testConvertGigJpg()
    {
        \Event::fake(\App\Events\Stats\ImageResizedOnDemand::class);
        \Http::fake([
            'https://example.com/gigs/image.jpg' => \Http::response(),
        ]);

        $this->mock(GetResizeImageWhitelistAction::class)
            ->expects('execute')
            ->andReturn(['example.com']);

        $imageConverter = $this->mock(ImageConverter::class);
        $imageConverter->expects('resize')->withArgs([400, 300])->andReturnSelf();
        $imageConverter->expects('quality')->andReturnSelf();
        $imageConverter->expects('convert')->andReturn(UploadedFile::fake()->image('image.jpg'));

        $this->get('resize/400x300/example.com/gigs/image.jpg')
            ->assertOk()
            ->assertHeader('Content-Type', 'image/jpeg');

        \Event::assertDispatched(\App\Events\Stats\ImageResizedOnDemand::class);
    }

    public function testConvertTripJpg()
    {
        \Event::fake(\App\Events\Stats\ImageResizedOnDemand::class);
        \Http::fake([
            'https://example.com/image.jpg' => \Http::response(),
        ]);

        $this->mock(GetResizeImageWhitelistAction::class)
            ->expects('execute')
            ->andReturn(['example.com']);

        $imageConverter = $this->mock(ImageConverter::class);
        $imageConverter->expects('resize')->withArgs([400, 300])->andReturnSelf();
        $imageConverter->expects('quality')->andReturnSelf();
        $imageConverter->expects('convert')->andReturn(UploadedFile::fake()->image('image.jpg'));

        $this->get('resize/400x300/example.com/image.jpg')
            ->assertOk()
            ->assertHeader('Content-Type', 'image/jpeg');

        \Event::assertDispatched(\App\Events\Stats\ImageResizedOnDemand::class);
    }

    public function testHostNotWhitelisted()
    {
        $this->get('resize/400x300/example.com/image.jpg')
            ->assertForbidden();
    }

    public function testNoDomain()
    {
        $this->get('resize/400x300')
            ->assertNotFound();
    }

    public function testNoExtension()
    {
        $this->mock(GetResizeImageWhitelistAction::class)
            ->expects('execute')
            ->andReturn(['example.com']);

        $this->get('resize/400x300/example.com/image')
            ->assertUnprocessable();
    }

    public function testNoPath()
    {
        $this->get('resize/400x300/example.com')
            ->assertNotFound();
    }

    public function testRemoteImageNotFound()
    {
        \Http::fake([
            'https://example.com/image.jpg' => \Http::response(status: 404),
        ]);

        $this->mock(GetResizeImageWhitelistAction::class)
            ->expects('execute')
            ->andReturn(['example.com']);

        $this->get('resize/400x300/example.com/image.jpg')
            ->assertNotFound();
    }
}

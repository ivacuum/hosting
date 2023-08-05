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

    public function testConvertJpg()
    {
        \Event::fake(\App\Events\Stats\ImageResizedOnDemand::class);
        \Http::fake([
            'https://example.com/image.jpg' => \Http::response(),
        ]);

        $this->mock(GetResizeImageWhitelistAction::class)
            ->expects('execute')
            ->andReturn(['https://example.com/']);

        $imageConverter = $this->mock(ImageConverter::class);
        $imageConverter->expects('resize')->withArgs([400, 300])->andReturnSelf();
        $imageConverter->expects('quality')->andReturnSelf();
        $imageConverter->expects('convert')->andReturn(UploadedFile::fake()->image('image.jpg'));

        $this->get('resize/400x300?image=https://example.com/image.jpg')
            ->assertOk()
            ->assertHeader('Content-Type', 'image/jpeg');

        \Event::assertDispatched(\App\Events\Stats\ImageResizedOnDemand::class);
    }

    public function testHostNotWhitelisted()
    {
        $this->get('resize/400x300?image=https://example.com/image.jpg')
            ->assertForbidden();
    }

    public function testNoExtension()
    {
        $this->mock(GetResizeImageWhitelistAction::class)
            ->expects('execute')
            ->andReturn(['https://example.com/']);

        $this->get('resize/400x300?image=https://example.com/image')
            ->assertUnprocessable();
    }

    public function testNoImage()
    {
        $this->get('resize/400x300')
            ->assertNotFound();
    }

    public function testRemoteImageNotFound()
    {
        \Http::fake([
            'https://example.com/image.jpg' => \Http::response(status: 404),
        ]);

        $this->mock(GetResizeImageWhitelistAction::class)
            ->expects('execute')
            ->andReturn(['https://example.com/']);

        $this->get('resize/400x300?image=https://example.com/image.jpg')
            ->assertNotFound();
    }
}

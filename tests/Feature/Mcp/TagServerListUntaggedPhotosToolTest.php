<?php

namespace Tests\Feature\Mcp;

use App\Domain\Life\Factory\PhotoFactory;
use App\Domain\Life\Mcp\Servers\TagServer;
use App\Domain\Life\Mcp\Tools\ListUntaggedPhotosTool;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TagServerListUntaggedPhotosToolTest extends TestCase
{
    use DatabaseTransactions;

    public function testListUntaggedPhotosReturnsOnlyPublishedUntagged(): void
    {
        $untagged = PhotoFactory::new()->withTrip()->withSlug('test/IMG_0001.jpg')->create();
        $tagged = PhotoFactory::new()->withTrip()->withSlug('test/IMG_0002.jpg')->withTag()->create();
        $hidden = PhotoFactory::new()->withTrip()->withSlug('test/IMG_0003.jpg')->hidden()->create();

        $response = TagServer::tool(ListUntaggedPhotosTool::class);

        $response
            ->assertOk()
            ->assertName('list-untagged-photos')
            ->assertSee($untagged->slug)
            ->assertSee($untagged->originalR2Url())
            ->assertDontSee($tagged->slug)
            ->assertDontSee($hidden->slug);
    }
}

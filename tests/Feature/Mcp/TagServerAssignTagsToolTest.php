<?php

namespace Tests\Feature\Mcp;

use App\Domain\Life\Factory\PhotoFactory;
use App\Domain\Life\Factory\TagFactory;
use App\Domain\Life\Mcp\Servers\TagServer;
use App\Domain\Life\Mcp\Tools\AssignTagsTool;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TagServerAssignTagsToolTest extends TestCase
{
    use DatabaseTransactions;

    public function testAssignTagsAttachAndIdempotent(): void
    {
        $photo = PhotoFactory::new()->withTrip()->create();
        $tag1 = TagFactory::new()->withTitle('phpunit закат', 'phpunit sunset')->create();
        $tag2 = TagFactory::new()->withTitle('phpunit река', 'phpunit river')->create();

        $response = TagServer::tool(AssignTagsTool::class, [
            'photo_id' => $photo->id,
            'tag_ids' => [$tag1->id, $tag2->id],
        ]);

        $response
            ->assertOk()
            ->assertName('assign-tags')
            ->assertStructuredContent(fn ($json) => $json
                ->where('photo_id', $photo->id)
                ->where('assigned', 2)
                ->where('already_present', 0)
                ->etc()
            );

        $this->assertSame(2, $photo->refresh()->tags()->count());

        $response = TagServer::tool(AssignTagsTool::class, [
            'photo_id' => $photo->id,
            'tag_ids' => [$tag1->id, $tag2->id],
        ]);

        $response
            ->assertOk()
            ->assertStructuredContent(fn ($json) => $json
                ->where('assigned', 0)
                ->where('already_present', 2)
                ->etc()
            );

        $this->assertSame(2, $photo->refresh()->tags()->count());
    }

    public function testAssignTagsRejectsUnknownPhoto(): void
    {
        $tag = TagFactory::new()->withTitle('phpunit закат', 'phpunit sunset')->create();

        TagServer::tool(AssignTagsTool::class, [
            'photo_id' => 999_999_999,
            'tag_ids' => [$tag->id],
        ])
            ->assertHasErrors(['Photo id 999999999 not found.']);
    }

    public function testAssignTagsRejectsUnknownTagIds(): void
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        TagServer::tool(AssignTagsTool::class, [
            'photo_id' => $photo->id,
            'tag_ids' => [999_999_999],
        ])
            ->assertHasErrors(['Unknown tag ids: 999999999. Call list_tags first.']);
    }
}

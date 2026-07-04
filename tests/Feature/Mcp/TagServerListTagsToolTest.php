<?php

namespace Tests\Feature\Mcp;

use App\Domain\Life\Factory\TagFactory;
use App\Domain\Life\Mcp\Servers\TagServer;
use App\Domain\Life\Mcp\Tools\ListTagsTool;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TagServerListTagsToolTest extends TestCase
{
    use DatabaseTransactions;

    public function testListTags(): void
    {
        TagFactory::new()->withTitle('железная дорога', 'railroad')->create();
        TagFactory::new()->withTitle('закат', 'sunset')->create();

        $response = TagServer::tool(ListTagsTool::class);

        $response
            ->assertOk()
            ->assertName('list-tags')
            ->assertStructuredContent(fn (AssertableJson $json) => $json
                ->has('total')
                ->has('tags')
                ->etc()
            );
    }
}

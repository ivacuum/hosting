<?php

namespace Tests\Feature\Mcp;

use App\Domain\Life\Factory\TagFactory;
use App\Domain\Life\Mcp\Servers\TagServer;
use App\Domain\Life\Mcp\Tools\CreateTagTool;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TagServerCreateTagToolTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreateTag(): void
    {
        $response = TagServer::tool(CreateTagTool::class, [
            'title_ru' => 'мост',
            'title_en' => 'bridge',
        ]);

        $response
            ->assertOk()
            ->assertName('create-tag')
            ->assertStructuredContent(fn ($json) => $json
                ->has('id')
                ->where('title_ru', 'мост')
                ->where('title_en', 'bridge')
                ->etc()
            );

        $this->assertDatabaseHas('tags', [
            'title_ru' => 'мост',
            'title_en' => 'bridge',
        ]);
    }

    public function testCreateTagRejectsDuplicateByEnTitle(): void
    {
        TagFactory::new()->withTitle('что-то', 'sunset')->create();

        TagServer::tool(CreateTagTool::class, [
            'title_ru' => 'что-то-ещё',
            'title_en' => 'sunset',
        ])->assertHasErrors();
    }

    public function testCreateTagRejectsDuplicateByRuTitle(): void
    {
        TagFactory::new()->withTitle('закат', 'sunset')->create();

        TagServer::tool(CreateTagTool::class, [
            'title_ru' => 'закат',
            'title_en' => 'something-else',
        ])->assertHasErrors();
    }
}

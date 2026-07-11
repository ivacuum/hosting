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
            'title_ru' => 'phpunit мост',
            'title_en' => 'phpunit bridge',
        ]);

        $response
            ->assertOk()
            ->assertName('create-tag')
            ->assertStructuredContent(fn ($json) => $json
                ->has('id')
                ->where('title_ru', 'phpunit мост')
                ->where('title_en', 'phpunit bridge')
                ->etc()
            );

        $this->assertDatabaseHas('tags', [
            'title_ru' => 'phpunit мост',
            'title_en' => 'phpunit bridge',
        ]);
    }

    public function testCreateTagRejectsDuplicateByEnTitle(): void
    {
        TagFactory::new()->withTitle('phpunit что-то', 'phpunit sunset')->create();

        TagServer::tool(CreateTagTool::class, [
            'title_ru' => 'phpunit что-то-ещё',
            'title_en' => 'phpunit sunset',
        ])->assertHasErrors();
    }

    public function testCreateTagRejectsDuplicateByRuTitle(): void
    {
        TagFactory::new()->withTitle('phpunit закат', 'phpunit sunset')->create();

        TagServer::tool(CreateTagTool::class, [
            'title_ru' => 'phpunit закат',
            'title_en' => 'phpunit something-else',
        ])->assertHasErrors();
    }
}

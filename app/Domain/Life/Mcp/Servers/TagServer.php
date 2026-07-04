<?php

namespace App\Domain\Life\Mcp\Servers;

use App\Domain\Life\Mcp\Tools\AssignTagsTool;
use App\Domain\Life\Mcp\Tools\CreateTagTool;
use App\Domain\Life\Mcp\Tools\ListTagsTool;
use App\Domain\Life\Mcp\Tools\ListUntaggedPhotosTool;
use Laravel\Mcp\Server;
use Laravel\Mcp\Server\Attributes\Instructions;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Version;

#[Name('Tag Server')]
#[Instructions('Tag Server exposes tools for tagging photos on vacuum.name. The typical workflow: call list_tags to get the controlled vocabulary, call list_untagged_photos (paginated) to find photos needing tags, optionally call create_tag for salient concepts not in the vocabulary, then call assign_tags with photo_id and tag_ids. Recognition itself is performed by the client; this server only reads and writes DB state.')]
#[Version('1.0.0')]
class TagServer extends Server
{
    protected array $tools = [
        AssignTagsTool::class,
        CreateTagTool::class,
        ListTagsTool::class,
        ListUntaggedPhotosTool::class,
    ];

    protected array $resources = [
        //
    ];

    protected array $prompts = [
        //
    ];
}

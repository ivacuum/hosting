<?php

namespace Tests\Feature\Mcp;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TagServerTest extends TestCase
{
    use DatabaseTransactions;

    public function testHttpPassesWithValidToken(): void
    {
        $this->postJson('mcp/tags', [
            'jsonrpc' => '2.0',
            'id' => 1,
            'method' => 'initialize',
            'params' => [
                'protocolVersion' => '2025-06-18',
                'clientInfo' => ['name' => 'test', 'version' => '1.0.0'],
            ],
        ], ['Authorization' => 'Bearer test-mcp-token'])
            ->assertOk();
    }

    public function testHttpUnauthorizedWithWrongToken(): void
    {
        $this->postJson('mcp/tags', [], ['Authorization' => 'Bearer wrong'])
            ->assertUnauthorized();
    }

    public function testHttpUnauthorizedWithoutToken(): void
    {
        $this->postJson('mcp/tags')
            ->assertUnauthorized();
    }
}

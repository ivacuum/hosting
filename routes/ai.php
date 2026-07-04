<?php

use App\Domain\Life\Mcp\Servers\TagServer;
use App\Http\Middleware\McpTokenAuth;
use Laravel\Mcp\Facades\Mcp;

Mcp::web('mcp/tags', TagServer::class)
    ->middleware(['throttle:mcp', McpTokenAuth::class]);

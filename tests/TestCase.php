<?php

namespace Tests;

use Illuminate\Foundation\Testing\WithCachedConfig;
use Illuminate\Foundation\Testing\WithCachedRoutes;

abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    use WithCachedConfig;
    use WithCachedRoutes;

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        \Http::preventStrayRequests();
        $this->withoutDeprecationHandling();
        $this->withoutMix();
        $this->withoutVite();
    }
}

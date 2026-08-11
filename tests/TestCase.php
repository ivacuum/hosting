<?php

namespace Tests;

use Illuminate\Foundation\Testing\WithCachedConfig;
use Illuminate\Foundation\Testing\WithCachedRoutes;

abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    use WithCachedConfig;
    use WithCachedRoutes;

    protected function setUp(): void
    {
        parent::setUp();

        if (!$this->withoutBootingFramework()) {
            \Http::preventStrayRequests();
            $this->withoutDeprecationHandling();
            $this->withoutMix();
            $this->withoutVite();

            // По умолчанию, есть задержка 200 мс
            // Ноль ускоряет тесты входа и выхода
            config(['auth.timebox_duration' => 0]);
        }
    }
}

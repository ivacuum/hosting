<?php

namespace Tests;

abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        \Http::preventStrayRequests();
        // $this->withoutDeprecationHandling();
    }
}

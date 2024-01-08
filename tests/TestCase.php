<?php

namespace Tests;

abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    use CreatesApplication;

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        \Http::preventStrayRequests();
        // $this->withoutDeprecationHandling();
    }
}

<?php

namespace Tests\Feature;

use App\Domain\Sphinx\SphinxScoutEngine;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Scout\EngineManager;
use Tests\TestCase;

class ScoutServiceProviderTest extends TestCase
{
    use DatabaseTransactions;

    public function testSphinxEngineIsRegistered(): void
    {
        config(['scout.driver' => 'sphinx']);

        $engine = app(EngineManager::class)->engine('sphinx');

        $this->assertInstanceOf(SphinxScoutEngine::class, $engine);
    }
}

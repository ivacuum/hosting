<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RetrackerTest extends TestCase
{
    use DatabaseTransactions;

    public function testDev(): void
    {
        $this->get('retracker/dev')
            ->assertOk()
            ->assertHasCustomTitle();
    }

    public function testIndex(): void
    {
        $this->get('retracker')
            ->assertOk()
            ->assertHasCustomTitle();
    }

    public function testUsage(): void
    {
        $this->get('retracker/usage')
            ->assertOk()
            ->assertHasCustomTitle();
    }
}

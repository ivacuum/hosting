<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WanikaniLevelsTest extends TestCase
{
    use DatabaseTransactions;

    public function testOk(): void
    {
        $this->get('japanese/wanikani/level')
            ->assertOk()
            ->assertHasCustomTitle();
    }
}

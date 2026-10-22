<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class KoreanPsyTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex(): void
    {
        $this->get('korean/psy')
            ->assertOk()
            ->assertHasCustomTitle();
    }

    public function testShow(): void
    {
        $this->get('korean/psy/champion')
            ->assertOk()
            ->assertHasCustomTitle();
    }
}

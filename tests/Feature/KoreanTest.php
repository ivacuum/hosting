<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class KoreanTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex(): void
    {
        $this->get('korean')
            ->assertOk()
            ->assertHasCustomTitle();
    }
}

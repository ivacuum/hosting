<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class KoreanPsyTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('korean/psy')
            ->assertOk()
            ->assertHasCustomTitle();
    }
}

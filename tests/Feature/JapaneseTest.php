<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('japanese')
            ->assertOk()
            ->assertHasCustomTitle();
    }
}

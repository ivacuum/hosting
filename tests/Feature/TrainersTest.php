<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TrainersTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('trainers')
            ->assertOk()
            ->assertHasCustomTitle();
    }
}

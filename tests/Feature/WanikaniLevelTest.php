<?php namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WanikaniLevelTest extends TestCase
{
    use DatabaseTransactions;

    public function testOk()
    {
        $this->get('japanese/wanikani/level/1')
            ->assertOk()
            ->assertHasCustomTitle();
    }
}

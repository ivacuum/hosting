<?php namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WanikaniTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('japanese/wanikani')
            ->assertStatus(200)
            ->assertHasCustomTitle();
    }
}

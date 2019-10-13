<?php namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWanikaniLevelTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('japanese/wanikani/level')
            ->assertStatus(200);
    }

    public function testShow()
    {
        $this->get('japanese/wanikani/level/1')
            ->assertStatus(200);
    }
}

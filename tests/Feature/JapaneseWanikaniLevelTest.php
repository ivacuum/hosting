<?php namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWanikaniLevelTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get(action('JapaneseWanikaniLevel@index'))
            ->assertStatus(200);
    }

    public function testShow()
    {
        $this->get(action('JapaneseWanikaniLevel@show', 1))
            ->assertStatus(200);
    }
}
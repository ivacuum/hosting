<?php namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWanikaniTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get(action('JapaneseWanikani@index'))
            ->assertStatus(200);
    }
}
<?php namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWordsTrainerTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('japanese/words-trainer')
            ->assertStatus(200)
            ->assertHasCustomTitle();
    }
}

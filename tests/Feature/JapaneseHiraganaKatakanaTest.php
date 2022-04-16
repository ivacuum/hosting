<?php namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseHiraganaKatakanaTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('japanese/hiragana-katakana')
            ->assertOk()
            ->assertHasCustomTitle();
    }
}

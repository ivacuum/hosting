<?php namespace Tests\Feature;

use App\Http\Controllers\JapaneseHiraganaKatakana;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseHiraganaKatakanaTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get(action([JapaneseHiraganaKatakana::class, 'index']))
            ->assertStatus(200);
    }
}

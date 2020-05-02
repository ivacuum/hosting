<?php namespace Tests\Feature;

use App\Factory\KanjiFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWanikaniKanjiTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('japanese/wanikani/kanji')
            ->assertStatus(200)
            ->assertHasCustomTitle();
    }

    public function testShow()
    {
        $kanji = KanjiFactory::new()->create();

        $this->get("japanese/wanikani/kanji/{$kanji->character}")
            ->assertStatus(200)
            ->assertViewHas(['kanji' => $kanji])
            ->assertSee($kanji->character)
            ->assertHasCustomTitle();
    }
}

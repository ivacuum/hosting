<?php namespace Tests\Feature;

use App\Factory\KanjiFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWanikaniKanjiTest extends TestCase
{
    use DatabaseTransactions;

    public function testBurn()
    {
        $kanji = KanjiFactory::new()->create();

        $this->be($user = UserFactory::new()->create())
            ->delete("japanese/wanikani/kanji/{$kanji->id}")
            ->assertNoContent();

        $this->assertEquals($user->id, $kanji->burnable->user_id);
    }

    public function testIndex()
    {
        $this->get('japanese/wanikani/kanji')
            ->assertStatus(200)
            ->assertViewIs('japanese.wanikani.vue');
    }

    public function testIndexJson()
    {
        $level = 60;
        $kanji = KanjiFactory::new()->withLevel($level)->create();

        $json = $this->getJson('japanese/wanikani/kanji')
            ->assertStatus(200)
            ->json("data.{$level}");

        $this->assertContains($kanji->id, array_column($json, 'id'));
    }

    public function testShow()
    {
        $kanji = KanjiFactory::new()->create();

        $this->get("japanese/wanikani/kanji/{$kanji->character}")
            ->assertStatus(200)
            ->assertViewIs('japanese.wanikani.vue');
    }

    public function testShowJson()
    {
        $kanji = KanjiFactory::new()->create();

        $this->getJson("japanese/wanikani/kanji/{$kanji->character}")
            ->assertStatus(200)
            ->assertJson(['data' => ['id' => $kanji->id]]);
    }

    public function testResurrect()
    {
        $this->be($user = UserFactory::new()->create());

        $kanji = KanjiFactory::new()->create();
        $kanji->burn($user->id);

        $this->put("japanese/wanikani/kanji/{$kanji->id}")
            ->assertNoContent();

        $this->assertNull($kanji->burnable);
    }
}

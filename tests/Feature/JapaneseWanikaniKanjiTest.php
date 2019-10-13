<?php namespace Tests\Feature;

use App\Kanji;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWanikaniKanjiTest extends TestCase
{
    use DatabaseTransactions;

    public function testBurn()
    {
        $this->be($user = $this->user());

        $kanji = $this->kanji();

        $this->delete("japanese/wanikani/kanji/{$kanji->id}")
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
        $kanji = $this->kanji(['level' => $level]);

        $json = $this->getJson('japanese/wanikani/kanji')
            ->assertStatus(200)
            ->json("data.{$level}");

        $this->assertContains($kanji->id, array_column($json, 'id'));
    }

    public function testShow()
    {
        $kanji = $this->kanji();

        $this->get("japanese/wanikani/kanji/{$kanji->character}")
            ->assertStatus(200)
            ->assertViewIs('japanese.wanikani.vue');
    }

    public function testShowJson()
    {
        $kanji = $this->kanji();

        $this->getJson("japanese/wanikani/kanji/{$kanji->character}")
            ->assertStatus(200)
            ->assertJson(['data' => ['id' => $kanji->id]]);
    }

    public function testResurrect()
    {
        $this->be($user = $this->user());

        $kanji = $this->kanji();
        $kanji->burn($user->id);

        $this->put("japanese/wanikani/kanji/{$kanji->id}")
            ->assertNoContent();

        $this->assertNull($kanji->burnable);
    }

    private function kanji(array $attributes = []): Kanji
    {
        return factory(Kanji::class)->create($attributes);
    }

    private function user(): User
    {
        return factory(User::class)->create();
    }
}

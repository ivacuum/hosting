<?php namespace Tests\Feature;

use App\User;
use App\Vocabulary;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWanikaniVocabularyTest extends TestCase
{
    use DatabaseTransactions;

    public function testBurn()
    {
        $this->be($user = $this->user());

        $vocab = $this->vocabulary();

        $this->delete("japanese/wanikani/vocabulary/{$vocab->id}")
            ->assertNoContent();

        $this->assertEquals($user->id, $vocab->burnable->user_id);
    }

    public function testIndex()
    {
        $this->get('japanese/wanikani/vocabulary')
            ->assertStatus(200)
            ->assertViewIs('japanese.wanikani.vue');
    }

    public function testIndexJson()
    {
        $level = 60;
        $vocab = $this->vocabulary(['level' => $level]);

        $json = $this->getJson('japanese/wanikani/vocabulary')
            ->assertStatus(200)
            ->json("data.{$level}");

        $this->assertContains($vocab->id, array_column($json, 'id'));
    }

    public function testShow()
    {
        $vocab = $this->vocabulary();

        $this->get("japanese/wanikani/vocabulary/{$vocab->character}")
            ->assertStatus(200)
            ->assertViewIs('japanese.wanikani.vue');
    }

    public function testShowJson()
    {
        $vocab = $this->vocabulary();

        $this->getJson("japanese/wanikani/vocabulary/{$vocab->character}")
            ->assertStatus(200)
            ->assertJson(['data' => ['id' => $vocab->id]]);
    }

    public function testResurrect()
    {
        $this->be($user = $this->user());

        $vocab = $this->vocabulary();
        $vocab->burn($user->id);

        $this->put("japanese/wanikani/vocabulary/{$vocab->id}")
            ->assertNoContent();

        $this->assertNull($vocab->burnable);
    }

    private function vocabulary(array $attributes = []): Vocabulary
    {
        return factory(Vocabulary::class)->create($attributes);
    }

    private function user(): User
    {
        return factory(User::class)->create();
    }
}

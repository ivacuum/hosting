<?php namespace Tests\Feature;

use App\Factory\UserFactory;
use App\Factory\VocabularyFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWanikaniVocabularyTest extends TestCase
{
    use DatabaseTransactions;

    public function testBurn()
    {
        $vocab = VocabularyFactory::new()->create();

        $this->be($user = UserFactory::new()->create())
            ->delete("japanese/wanikani/vocabulary/{$vocab->id}")
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
        $vocab = VocabularyFactory::new()->withLevel($level)->create();

        $json = $this->getJson('japanese/wanikani/vocabulary')
            ->assertStatus(200)
            ->json("data.{$level}");

        $this->assertContains($vocab->id, array_column($json, 'id'));
    }

    public function testShow()
    {
        $vocab = VocabularyFactory::new()->create();

        $this->get("japanese/wanikani/vocabulary/{$vocab->character}")
            ->assertStatus(200)
            ->assertViewIs('japanese.wanikani.vue');
    }

    public function testShowJson()
    {
        $vocab = VocabularyFactory::new()->create();

        $this->getJson("japanese/wanikani/vocabulary/{$vocab->character}")
            ->assertStatus(200)
            ->assertJson(['data' => ['id' => $vocab->id]]);
    }

    public function testResurrect()
    {
        $this->be($user = UserFactory::new()->create());

        $vocab = VocabularyFactory::new()->create();
        $vocab->burn($user->id);

        $this->put("japanese/wanikani/vocabulary/{$vocab->id}")
            ->assertNoContent();

        $this->assertNull($vocab->burnable);
    }
}

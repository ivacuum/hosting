<?php namespace Tests\Feature;

use App\Factory\KanjiFactory;
use App\Factory\RadicalFactory;
use App\Vocabulary;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWanikaniSearchTest extends TestCase
{
    use DatabaseTransactions;

    public function testSearchForRadical()
    {
        $radical = RadicalFactory::new()->create();
        $q = $radical->meaning;

        $json = $this->post("japanese/wanikani/search?q={$q}")
            ->assertStatus(200)
            ->json('radicals.data');

        $this->assertContains($radical->id, array_column($json, 'id'));
    }

    public function testSearchForKanji()
    {
        $kanji = KanjiFactory::new()->create();
        $q = $kanji->meaning;

        $json = $this->post("japanese/wanikani/search?q={$q}")
            ->assertStatus(200)
            ->json('kanji.data');

        $this->assertContains($kanji->id, array_column($json, 'id'));
    }

    public function testSearchForVocabulary()
    {
        /** @var Vocabulary $vocab */
        $vocab = factory(Vocabulary::class)->create();
        $q = $vocab->meaning;

        $json = $this->post("japanese/wanikani/search?q={$q}")
            ->assertStatus(200)
            ->json('vocabulary.data');

        $this->assertContains($vocab->id, array_column($json, 'id'));
    }
}

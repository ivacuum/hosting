<?php namespace Tests\Feature;

use App\Http\Controllers\JapaneseWanikaniSearch;
use App\Kanji;
use App\Radical;
use App\Vocabulary;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWanikaniSearchTest extends TestCase
{
    use DatabaseTransactions;

    public function testSearchForRadical()
    {
        /** @var Radical $radical */
        $radical = factory(Radical::class)->create();
        $q = $radical->meaning;

        $json = $this->post(action([JapaneseWanikaniSearch::class, 'index']), ['q' => $q])
            ->assertStatus(200)
            ->json('radicals.data');

        $this->assertContains($radical->id, array_column($json, 'id'));
    }

    public function testSearchForKanji()
    {
        /** @var Kanji $kanji */
        $kanji = factory(Kanji::class)->create();
        $q = $kanji->meaning;

        $json = $this->post(action([JapaneseWanikaniSearch::class, 'index']), ['q' => $q])
            ->assertStatus(200)
            ->json('kanji.data');

        $this->assertContains($kanji->id, array_column($json, 'id'));
    }

    public function testSearchForVocabulary()
    {
        /** @var Vocabulary $vocab */
        $vocab = factory(Vocabulary::class)->create();
        $q = $vocab->meaning;

        $json = $this->post(action([JapaneseWanikaniSearch::class, 'index']), ['q' => $q])
            ->assertStatus(200)
            ->json('vocabulary.data');

        $this->assertContains($vocab->id, array_column($json, 'id'));
    }
}

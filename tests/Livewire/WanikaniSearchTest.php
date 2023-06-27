<?php

namespace Tests\Livewire;

use App\Factory\KanjiFactory;
use App\Factory\RadicalFactory;
use App\Factory\VocabularyFactory;
use App\Http\Livewire\WanikaniSearch;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WanikaniSearchTest extends TestCase
{
    use DatabaseTransactions;

    public function testSearchForRadical()
    {
        $radical = RadicalFactory::new()->create();

        \Livewire::test(WanikaniSearch::class)
            ->set('q', $radical->meaning)
            ->call('search')
            ->assertViewHas('radicals', fn (Collection $radicals) => $radicals->firstWhere('id', $radical->id) !== null);
    }

    public function testSearchForKanji()
    {
        $kanji = KanjiFactory::new()->create();

        \Livewire::test(WanikaniSearch::class)
            ->set('q', $kanji->meaning)
            ->call('search')
            ->assertViewHas('kanjis', fn (Collection $kanjis) => $kanjis->firstWhere('id', $kanji->id) !== null);
    }

    public function testSearchForVocabulary()
    {
        $vocab = VocabularyFactory::new()->create();

        \Livewire::test(WanikaniSearch::class)
            ->set('q', $vocab->meaning)
            ->call('search')
            ->assertViewHas('vocabularies', fn (Collection $vocabularies) => $vocabularies->firstWhere('id', $vocab->id) !== null);
    }
}

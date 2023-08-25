<?php

namespace Tests\Livewire;

use App\Action\SplitVocabToKanjiAction;
use App\Collection\ShowKanjiInTheSameOrderAsInVocab;
use App\Factory\KanjiFactory;
use App\Factory\VocabularyFactory;
use App\Http\Livewire\KanjiList;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class KanjiListTest extends TestCase
{
    use DatabaseTransactions;

    public function testLevel()
    {
        KanjiFactory::new()->withLevel(99)->create();

        $kanji = KanjiFactory::new()->withLevel(99)->create();

        \Livewire::test(KanjiList::class, ['level' => 99])
            ->assertSee($kanji->character);
    }

    public function testVocabKanjiSort()
    {
        $kanji3 = KanjiFactory::new()->withCharacter('3')->withLevel(99)->create();
        $kanji2 = KanjiFactory::new()->withCharacter('2')->withLevel(99)->create();
        $kanji1 = KanjiFactory::new()->withCharacter('1')->withLevel(99)->create();
        VocabularyFactory::new()->withCharacter('21Ыつ3')->withLevel(99)->create();

        $characters = app(SplitVocabToKanjiAction::class)->execute('213');

        $this->assertSame(['2', '1', '3'], $characters);

        $collect = (new Collection([$kanji1, $kanji2, $kanji3]))
            ->pipe(new ShowKanjiInTheSameOrderAsInVocab($characters));

        $this->assertSame([$kanji2->id, $kanji1->id, $kanji3->id], $collect->pluck('id')->all());
        $this->assertSame([0, 10, 20], $collect->pluck('sort')->all());
    }
}

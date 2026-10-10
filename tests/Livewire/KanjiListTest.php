<?php

namespace Tests\Livewire;

use App\Domain\Wanikani\Action\SplitVocabToKanjiAction;
use App\Domain\Wanikani\Collection\ShowKanjiInTheSameOrderAsInVocab;
use App\Domain\Wanikani\Factory\KanjiFactory;
use App\Domain\Wanikani\Livewire\KanjiList;
use App\Factory\UserFactory;
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

    public function testShowLabels()
    {
        KanjiFactory::new()->withLevel(99)->create();

        $kanji = KanjiFactory::new()->withLevel(99)->create();

        $this->be(UserFactory::new()->create());

        \Livewire::test(KanjiList::class, ['level' => 99])
            ->toggle('showLabels')
            ->assertSee($kanji->character);
    }

    public function testShuffle()
    {
        KanjiFactory::new()->withLevel(99)->create();

        $kanji = KanjiFactory::new()->withLevel(99)->create();

        $this->be(UserFactory::new()->create());

        \Livewire::test(KanjiList::class, ['level' => 99])
            ->call('shuffle')
            ->assertSee($kanji->character);
    }

    public function testVocabKanjiSort(): void
    {
        $day = KanjiFactory::new()->withCharacter('日')->make();
        $good = KanjiFactory::new()->withCharacter('善')->make();
        $one = KanjiFactory::new()->withCharacter('一')->make();

        $characters = app(SplitVocabToKanjiAction::class)->execute('一日一善');

        $collect = new Collection([$day, $good, $one])
            ->pipe(new ShowKanjiInTheSameOrderAsInVocab($characters));

        $this->assertSame(['一', '日', '善'], $collect->pluck('character')->all());
    }
}

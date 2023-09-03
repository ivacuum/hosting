<?php

namespace App\Livewire;

use App\Action\SplitVocabToKanjiAction;
use App\Collection\ShowKanjiInTheSameOrderAsInVocab;
use App\Kanji;
use App\Scope\KanjiLevelScope;
use App\Scope\KanjiRadicalsScope;
use App\Scope\KanjiSimilarToScope;
use App\Scope\UserBurnableScope;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class KanjiList extends Component
{
    /** @var \Illuminate\Database\Eloquent\Collection|Kanji[] */
    public $kanjis;

    public int|null $level = null;
    public int|null $similarId = null;
    public bool $flat = false;
    public bool $range = false;
    public bool $showBurned = false;
    public bool $showLabels = false;

    public function mount(SplitVocabToKanjiAction $splitVocabToKanji, int $radicalId = null, string $vocabularyWord = null)
    {
        $this->flat = $this->similarId !== null || $vocabularyWord !== null;

        $characters = $splitVocabToKanji->execute($vocabularyWord ?? '');

        $this->kanjis = Kanji::query()
            ->tap(new UserBurnableScope(auth()->id()))
            ->tap(new KanjiRadicalsScope($radicalId))
            ->tap(new KanjiSimilarToScope($this->similarId))
            ->tap(new KanjiLevelScope($this->level))
            ->when($vocabularyWord, fn (Builder $query) => $query->whereIn('character', $characters))
            ->orderBy('level')
            ->orderBy('meaning')
            ->get(['id', 'level', 'character', 'meaning', 'onyomi', 'kunyomi', 'important_reading'])
            ->pipe(new ShowKanjiInTheSameOrderAsInVocab($characters));
    }

    public function shuffle()
    {
        $this->kanjis = $this->kanjis->shuffle();
    }
}

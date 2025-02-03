<?php

namespace App\Livewire;

use App\Action\SplitVocabToKanjiAction;
use App\Burnable;
use App\Collection\ShowKanjiInTheSameOrderAsInVocab;
use App\Kanji;
use App\Scope\KanjiLevelScope;
use App\Scope\KanjiRadicalsScope;
use App\Scope\KanjiSimilarToScope;
use App\User;
use Illuminate\Container\Attributes\CurrentUser;
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
    public array $burned = [];

    public function mount(SplitVocabToKanjiAction $splitVocabToKanji, #[CurrentUser] User|null $user = null, int|null $radicalId = null, string|null $vocabularyWord = null)
    {
        $this->flat = $this->similarId !== null || $vocabularyWord !== null;

        $characters = $splitVocabToKanji->execute($vocabularyWord ?? '');

        $this->kanjis = Kanji::query()
            ->tap(new KanjiRadicalsScope($radicalId))
            ->tap(new KanjiSimilarToScope($this->similarId))
            ->tap(new KanjiLevelScope($this->level))
            ->when($vocabularyWord, fn (Builder $query) => $query->whereIn('character', $characters))
            ->orderBy('level')
            ->orderBy('meaning')
            ->get(['id', 'level', 'character', 'meaning', 'onyomi', 'kunyomi', 'important_reading'])
            ->pipe(new ShowKanjiInTheSameOrderAsInVocab($characters));

        if ($user) {
            $this->burned = Burnable::query()
                ->where('user_id', $user->id)
                ->where('rel_type', (new Kanji)->getMorphClass())
                ->whereIn('rel_id', $this->kanjis->pluck('id'))
                ->pluck('rel_id')
                ->flip()
                ->all();
        }
    }

    public function shuffle()
    {
        $this->kanjis = $this->kanjis->shuffle();
    }
}
